<?php

namespace App\Repository;

use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;

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

    public function findConversationListUser(User $user)
    {
        $rsm = new ResultSetMapping();
        $rsm
            ->addScalarResult('user_id', 'user_id')
            ->addScalarResult('first_name', 'first_name')
            ->addScalarResult('last_name', 'last_name')
            ->addScalarResult('path', 'path');

        return $this->getEntityManager()->createNativeQuery('
select distinct
                CASE
                    WHEN m.user_id_to = :id THEN user_from.user_id
                    ELSE user_to.user_id
                    END as user_id,
                CASE
                    WHEN m.user_id_to = :id THEN user_from.first_name
                    ELSE user_to.first_name
                    END as first_name,
                CASE
                    WHEN m.user_id_to = :id THEN user_from.last_name
                    ELSE user_to.last_name
                    END as last_name,
                CASE
                    WHEN m.user_id_to = :id THEN user_from.path
                    ELSE user_to.path
                    END as path
from message m
         inner join (select p.user_id, p.first_name, p.last_name, p2.path
                     from profile p
                              inner join picture p2 on p.picture_id = p2.id
) user_from on m.user_id_from = user_from.user_id
         inner join (select p.user_id, p.first_name, p.last_name, p2.path
                     from profile p
                              inner join picture p2 on p.picture_id = p2.id
) user_to on m.user_id_to = user_to.user_id
where m.user_id_from = :id
   or m.user_id_to = :id;', $rsm)
            ->setParameter('id', $user->getId())
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
