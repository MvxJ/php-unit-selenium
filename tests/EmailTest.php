<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public static function emailProvider(): array
    {
        return [
            'valid email' => ['john@example.com'],
            'valid email #2' => ['john@doe.com'],
            'valid email #3' => ['john@example.doe']
        ];
    }

    public static function numberProvider(): array
    {
        return [
            'valid result 1*2=2' =>[1,2,2],
            'valid result 2*2=4' => [2,2,4],
            'invalid result 3*3=12' => [3,3,9]
        ];
    }

    /**
     * @dataProvider emailProvider
     */
    public function testValidEmail($email)
    {
        $this->assertMatchesRegularExpression('/^.+\@\S+\.\S+$/', $email);
    }

    /**
     * @dataProvider numberProvider
     */
    public function testMathOperation($factor, $multiplyBy, $expected)
    {
        $result = $factor * $multiplyBy;

        $this->assertEquals($expected, $result);
    }
}