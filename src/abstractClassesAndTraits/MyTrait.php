<?php

namespace App\Abstract;

trait MyTrait
{
    public function traitMethod($number)
    {
        return $number + 10;
    }
}