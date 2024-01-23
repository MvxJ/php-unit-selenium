<?php

use App\Stub\Logger;
use App\Stub\Product;
use PHPUnit\Framework\TestCase;

class ProductMockTest extends TestCase
{
    public function testSaveProduct()
    {
        // $logger = new Logger;
        // $loggerMock = $this->getMockBuilder(Logger::class)
        //     ->disableOriginalConstructor()
        //     ->onlyMethods(['log'])
        //     ->getMock();
        $loggerMock = $this->createMock(Logger::class);
        $loggerMock->expects($this->once())
            ->method('log')
            ->with(
                $this->equalTo('error'),
                $this->anything()
            );
        $product = new Product($loggerMock);

        $this->assertFalse($product->saveProduct('panasonic', 'price'));
    }

    //Removed since PHPUNIT 10
    // public function testSaveProductCorrect()
    // {
    //     $loggerMock = $this->createMock(Logger::class);
    //     $loggerMock->expects($this->exactly(2))
    //         ->method('log')
    //         ->withConsecutive(
    //             [$this->equalTo('notice'), $this->stringContains('greater than')],
    //             [$this->equalTo('success'), $this->stringContains('was saved')]
    //         );
    //     $product = new Product($loggerMock);
        
    //     $this->assertFalse($product->saveProduct('panasonic', 11));
    // }
}