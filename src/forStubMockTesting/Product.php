<?php

namespace App\Stub;

class Product
{
    protected Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function saveProduct($name, $price)
    {
        if (!is_string($name)) {
            $this->logger->log('error', 'invalid name');

            return false;
        }

        if (!is_int($price)) {
            $this->logger->log('error', 'invalid price');

            return false;
        }

        if ($price > 10) {
            $this->logger->log('notice', 'proce greater than 10');
        }

        $this->logger->log('succes', 'product was saved');

        return true;
    }
}