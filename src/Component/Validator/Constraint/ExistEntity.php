<?php


namespace App\Component\Validator\Constraint;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation()
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class ExistEntity extends Constraint
{
    public $message = 'This value is not exist.';
    /**
     * @var string
     */
    public $entityClass;
    public $properties = [];
    public $repositoryMethod = 'findBy';

    /**
     * {@inheritdoc}
     */
    public function getRequiredOptions(): array
    {
        return ['entityClass', 'properties'];
    }
}