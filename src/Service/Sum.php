<?php

namespace App\Service;

class Sum {

    public function faireLaSomme(float ...$nombres) {
        $sum = 0;
        foreach ($nombres as $n) $sum += $n;
        return $sum;
    }
}
