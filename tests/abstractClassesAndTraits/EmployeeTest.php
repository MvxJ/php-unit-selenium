<?php

use App\Abstract\PersonAbstract;
use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase
{
    public function testFullName()
    {
        $mock = $this->getMockBuilder(PersonAbstract::class)
            ->setConstructorArgs(['john', 'doe'])
            ->getMockForAbstractClass();
        $mock->expects($this->any())
            ->method('getSalary')
            ->willReturn(6000);

        $this->assertSame('john doe earns 6000 per month', $mock->getFullNameAndSalary());
    }
}