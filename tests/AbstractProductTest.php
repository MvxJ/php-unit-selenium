<?php

namespace Tests;

use App\AbstractProduct;
use PHPUnit\Framework\TestCase;

class AbstractProductTest extends TestCase
{
    public function testProductAbstract()
    {
        $abstractProduct = new class extends AbstractProduct {};

        $this->assertSame('done', $abstractProduct->doSomething());
    }
}