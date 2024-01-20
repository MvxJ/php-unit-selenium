<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class DependenciesTest extends TestCase
{
    protected $value;

    public function testFirstTest(): int
    {
        $this->value = 1;

        $this->assertEquals(1, $this->value);

        return $this->value;
    }

    /**
     * @depends testFirstTest
     */
    public function testFirstDependencyTest(int $value): int
    {
        $value++;

        $this->assertEquals(2, $value);

        return $value;
    }

    /**
     *@depends testFirstDependencyTest
     */
    public function testSecondDependencyTest(int $value)
    {
        $value--;

        $this->assertEquals(1, $value);
    }
}