<?php

namespace App\Validator;

use Exception;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MultipleDeValidator extends ConstraintValidator {
    public function validate($value, Constraint $constraint) {

        if ($constraint->multiple == 0) throw new Exception('Attention, on ne peut pas diviser par zéro !');

        $div = $value / $constraint->multiple;

        if ($div != intval($div)) {
            $this->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ multiple }}', $constraint->multiple)
                ->addViolation();
        }
    }
}
