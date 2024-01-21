<?php

namespace Tests\traits;

use App\ShoppingCart;

trait ShoppingCartFixturesTrait
{
    protected $cart;

    protected function setUp(): void
    {
        $this->cart = new ShoppingCart();
    }

    protected function tearDown(): void
    {
        unset($this->cart);
    }
}