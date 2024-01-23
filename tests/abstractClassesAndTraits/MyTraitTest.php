<?php

use PHPUnit\Framework\TestCase;
use App\Abstract\MyTrait;

class MyTraitTest extends TestCase
{
    public function testMyMethod()
    {
        $mock = $this->getMockBuilder(MyTrait::class)->getMockForTrait();

        $this->assertSame(20, $mock->traitMethod(10));
    }
}