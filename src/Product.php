<?php

namespace App;

class Product extends AbstractProduct
{
    protected $addLoggerCallable = [Logger::class, 'log'];

    protected SessionInterface $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function setAddLoggerCallable(callable $callable)
    {
        $this->addLoggerCallable = $callable;
    }

    public function fetchProductById($id)
    {
        //Fetch product from database by id

        $product = 'product 1';

        $this->session->write($product);

//        Logger::log($product);
        call_user_func($this->addLoggerCallable, $product);

        return $product;
    }
}