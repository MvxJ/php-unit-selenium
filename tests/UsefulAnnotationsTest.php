<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class UsefulAnnotationsTest extends TestCase
{
    protected int $value;

    /**
     * @before
     */
    public function runBeforeEachTestMethod(): void
    {
        $this->value = 1;
    }

    /**
     * @after
     */
    public function runAfterEachTestMethod(): void
    {
        unset($this->value);
    }

    public function testFirstAnnotation(): int
    {
        $this->value++;

        $expected = 2;
        $result = $this->value;

        $this->assertEquals($expected, $result);

        return $this->value;
    }

    /**
     * @depends testFirstAnnotation
     */
    public function testSecondAnnotation(int $value): void
    {
        $value++;

        $expected = 3;
        $result = $value;

        $this->assertEquals($expected, $result);
    }
}