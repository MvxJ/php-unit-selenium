<?php

namespace App;

interface SessionInterface
{
    public function open();

    public function close();

    public function write($product);
}