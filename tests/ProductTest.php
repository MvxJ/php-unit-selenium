<?php

namespace Tests;

use App\Product;
use App\Session;
use App\SessionInterface;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProduct()
    {
        $mockSession = new class implements SessionInterface {
            public function open()
            {
            }

            public function close()
            {
            }

            public function write($product)
            {
            }
        };

        $product = new Product($mockSession);
        $product->setAddLoggerCallable(function() {
            echo 'mocker logger';
        });

        $this->assertSame('product 1', $product->fetchProductById(1));
    }

    public function testIncompleteTest()
    {
        $this->markTestIncomplete('This test isnt complete yet');

        $this->assertTrue(true);
    }

    public function testSkippTest()
    {
        if (!extension_loaded('xdebug')) {
            $this->markTestSkipped('The XDEBUG is not installed');
        }

        $this->assertTrue(true);
    }
}