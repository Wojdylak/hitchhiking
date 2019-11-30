<?php


namespace App\Component\Validator\Constraint;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ExistEntityValidator extends ConstraintValidator
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ExistEntity) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\ExistEntity');
        }
        if (null === $value) {
            return;
        }
        $properties = (array) $constraint->properties;


        $class = $this->entityManager->getClassMetadata($constraint->entityClass);
        $criteria = [];
        foreach ($properties as $propertyName) {
            if (!$class->hasField($propertyName)) {
                throw new ConstraintDefinitionException(
                    sprintf('The field "%s" is not mapped by Doctrine, so it cannot be validated for existence.', $propertyName)
                );
            }
            $criteria[$propertyName] = $value;
        }
        $repository = $this->entityManager->getRepository($constraint->entityClass);
        $result = $repository->{$constraint->repositoryMethod}($criteria);
        if (0 !== \count($result)) {
            return;
        }
        $this->context->buildViolation($constraint->message)
            ->addViolation();
    }
}