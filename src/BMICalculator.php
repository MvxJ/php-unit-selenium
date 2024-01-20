<?php

namespace App;

class BMICalculator
{
    public $bmi;

    public $mass;

    public $height;

    public function calculate(): float
    {
        if ($this->mass <= 0 || $this->height <= 0) {
            throw new WrongBmiParamException('Wrong params');
        }

        return round($this->mass / pow($this->height, 2), 1);
    }

    public function getTextResultFromBMI(): string
    {
        if ($this->bmi < 18) {
            return 'UNDERWEIGHT';
        } elseif ( $this->bmi >= 18 && $this->bmi < 25) {
            return 'NORMAL';
        } else {
            return 'OVERWEIGHT';
        }
    }
}