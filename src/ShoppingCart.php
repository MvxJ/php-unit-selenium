<?php

namespace App;

class ShoppingCart
{
    public $cartItems = [];
    public $amount;

    public function addItem($item)
    {
        $this->cartItems[] = $item;
        $this->amount++;
    }
}