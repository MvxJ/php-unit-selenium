<?php

namespace Tests;

use App\BMICalculator;
use App\WrongBmiParamException;
use PHPUnit\Framework\TestCase;

class BMICalculatorTest extends TestCase
{
    protected BMICalculator $bmiCalculator;

    public function setUp(): void
    {
        $this->bmiCalculator = new BMICalculator();
    }

    public function tearDown(): void
    {
        unset($this->bmiCalculator);
    }

    public function testShowsUnderweightWhenBmiUnder18()
    {
        $this->bmiCalculator->bmi = 10;

        $expected = 'UNDERWEIGHT';
        $result = $this->bmiCalculator->getTextResultFromBMI();

        $this->assertSame($expected, $result);
    }

    public function testShowsNormalWhenBmiBetween18And25()
    {
        $this->bmiCalculator->bmi = 22;

        $expected = 'NORMAL';
        $result = $this->bmiCalculator->getTextResultFromBMI();

        $this->assertEquals($expected, $result);
    }

    public function testShowsOverweightWhenBmiGraterThan25()
    {
        $this->bmiCalculator->bmi = 28;

        $expected = 'OVERWEIGHT';
        $result = $this->bmiCalculator->getTextResultFromBMI();

        $this->assertSame($expected, $result);
    }

    public function testCalculateCorrectBmiValue()
    {
        $this->bmiCalculator->mass = 100;
        $this->bmiCalculator->height = 1.6;

        $expectedValue = 39.1;
        $result = $this->bmiCalculator->calculate();

        $this->assertEquals($expectedValue, $result);
    }

    public function testWrongParamExceptionIsThrownWhenHeightLessOrEqual0()
    {
        $this->bmiCalculator->mass = 0;
        $this->bmiCalculator->height = 175;

        $this->expectException(WrongBmiParamException::class);

        $this->bmiCalculator->calculate();
    }
}