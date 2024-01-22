<?php

namespace App;

class Session implements SessionInterface
{
    // @codeCoverageIgnoreStart
    public function open()
    {
        echo 'session opened';
    }

    public function close()
    {
        echo 'session closed';
    }

    public function write($product)
    {
        echo "$product was written to session";
    }
    // @codeCoverageIgnoreEnd
}