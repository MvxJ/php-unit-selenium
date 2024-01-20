<?php

namespace Tests;

use App\CustomeException;
use PHPUnit\Framework\TestCase;

class UsefulAssertionsTest extends TestCase
{
    public function testAssertSame()
    {
        $expected = 'baz';
        $result =  'baz';

        $this->assertSame($expected, $result);
    }

    public function testAssertEquals()
    {
        $expected = 1;
        $result = 1;

        $this->assertEquals($expected, $result);
    }

    public function testAssertIsEmpty()
    {
        $array = [];

        $this->assertEmpty($array);
    }

    public function testAssertIsNull()
    {
        $this->assertNull(null);
    }

    public function testAssertGreaterThan()
    {
        $this->assertGreaterThan(1, 2);
    }

    public function testAssertFalse()
    {
        $this->assertFalse(false);
    }

    public function testAssertTrue()
    {
        $this->assertTrue(true);
    }

    public function testAssertCount()
    {
        $this->assertCount(3, [1,2,3]);
    }

    public function testAssertContains()
    {
        $this->assertContains(1, [0,1,2,3]);
    }

    public function testAssertStringContainsString()
    {
        $this->assertStringContainsString('John', 'Hello John!');
    }

    public function testAssertInstanceOf()
    {
        $this->assertInstanceOf(\Exception::class, new CustomeException());
    }

    public function testAssertArrayHasKey()
    {
        $this->assertArrayHasKey('name', ['name' => 'John', 'surname' => 'Doe']);
    }

    public function testAssertDirectoryIsWritable()
    {
        $this->assertDirectoryIsWritable('./src');
    }

    public function testAssertFileIsWritable()
    {
        $this->assertFileIsWritable('README.md');
    }
}