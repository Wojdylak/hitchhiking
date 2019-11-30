<?php


namespace App\Component\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation()
 */
class UniqueEmail extends Constraint
{
    public $message = 'Email is not unique.';
}