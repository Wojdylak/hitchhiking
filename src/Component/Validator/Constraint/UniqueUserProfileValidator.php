<?php


namespace App\Component\Validator\Constraint;


use App\Entity\Profile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueUserProfileValidator extends ConstraintValidator
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UniqueUserProfile) {
            throw new UnexpectedTypeException($constraint, UniqueUserProfile::class);
        }
        $user = $this->tokenStorage->getToken()->getUser();
        $profile = $this->entityManager->getRepository(Profile::class)
            ->findOneBy(['user' => $user]);
        if (null !== $profile) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
            return;
        }
    }
}