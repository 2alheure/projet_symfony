<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MultipleDe extends Constraint {

    public $multiple = 1;
    public $message = 'La valeur doit être multiple de {{ multiple }}.';

    public function validatedBy() {
        return static::class . 'Validator';
    }
}
