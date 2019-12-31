<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function findListUserConversation($user)
    {
        return $this->createQueryBuilder('m')
            ->select(['userFrom.id userIdFrom', 'userTo.id userIdTo', 'profileTo.firstName firstNameTo', 'profileTo.lastName lastNameTo', 'pictureTo.path pathTo', 'profileFrom.firstName firstNameFrom', 'profileFrom.lastName lastNameFrom', 'pictureFrom.path pathFrom'])
            ->distinct()
            ->innerJoin('m.userIdTo', 'userTo')
            ->innerJoin('m.userIdFrom', 'userFrom')
            ->innerJoin('userTo.profile', 'profileTo')
            ->innerJoin('profileTo.picture', 'pictureTo')
            ->innerJoin('userFrom.profile', 'profileFrom')
            ->innerJoin('profileFrom.picture', 'pictureFrom')
            ->andWhere('userFrom.id = :id or userTo.id = :id')
            ->setParameter('id', $user->getId())
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Message[] Returns an array of Message objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Message
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
