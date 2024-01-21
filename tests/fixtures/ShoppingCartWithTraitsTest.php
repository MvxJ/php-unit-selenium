<?php

namespace Tests\fixtures;

use PHPUnit\Framework\TestCase;
use Tests\traits\DatabaseTrait;
use Tests\traits\ShoppingCartFixturesTrait;

class ShoppingCartWithTraitsTest extends TestCase
{
    use DatabaseTrait;
    use ShoppingCartFixturesTrait;

    public function testCorrectNumberOfItems()
    {
        $this->cart->addItem('one');

        $expected = 1;
        $result = $this->cart->amount;

        $this->assertEquals($expected, $result);
    }

    public function testCorrectProductName()
    {
        $this->cart->addItem('apple');

        $this->assertContains('apple', $this->cart->cartItems);
    }
}