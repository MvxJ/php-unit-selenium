<?php

use App\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    protected Calculator $calculator;

    public function setUp(): void
    {
        $this->calculator = new Calculator;
    }

    public function tearDown(): void
    {
        unset($this->calculator);
    }

    public function testAdd()
    {
        $expected = 5;
        $result = $this->calculator->add(2,3);

        $this->assertEquals($expected, $result);
    }

    public function testSubstract()
    {
        $expected = 3;
        $result = $this->calculator->subtract(8, 5);

        $this->assertEquals($expected, $result);
    }

    public function testDivide()
    {
        $expected = 5;
        $result = $this->calculator->divide(25, 5);

        $this->assertEquals($expected, $result);
    }

    public function testMultiply()
    {
        $expected = 36;
        $result = $this->calculator->multiply(3, 12);

        $this->assertEquals($expected, $result);
    }
}