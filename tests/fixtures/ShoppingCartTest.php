<?php

namespace Tests\fixtures;

use App\ShoppingCart;
use PHPUnit\Framework\TestCase;

class ShoppingCartTest extends TestCase
{
    protected $cart;
    protected static $dbConnection = false;

    public function setUp(): void
    {
        $this->cart = new ShoppingCart();
    }

    public function tearDown(): void
    {
        unset($this->cart);
    }

    public static function setUpBeforeClass(): void
    {
        if (self::$dbConnection) return;

        self::$dbConnection = new \PDO('sqlite::database.db');
    }

    public static function tearDownAfterClass(): void
    {
        self::$dbConnection = null;
        unlink(':database.db');
    }

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