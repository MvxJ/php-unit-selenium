<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class ErrorExceptionsTest extends TestCase
{
    public function testExceptionCanBeExpected(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('New exception');

        throw new \Exception('New exception');
    }
}