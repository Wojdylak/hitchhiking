<?php


namespace App\Component\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation()
 */
class UniqueUserProfile extends Constraint
{
    public $message = "This user already has a profile";

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}