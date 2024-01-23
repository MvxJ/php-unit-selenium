<?php

use App\Stub\User;
use PHPUnit\Framework\TestCase;

class UserStubTest extends TestCase
{
    public function testCreateUser()
    {
        // $user = new User;
        // $stub = $this->getMockBuilder(User::class)->getMock();
        // $stub = $this->createStub(User::class);
        // $stub = $this->getMockBuilder(User::class)->onlyMethods([])->getMock();
        $stub = $this->getMockBuilder(User::class)->disableOriginalConstructor()->onlyMethods(['save'])->getMock();
        $stub->method('save')->willReturn(true);

        $this->assertTrue($stub->createUser('john', 'john.doe@example.com'));
        $this->assertFalse($stub->createUser('john', 'john@example'));
    }
}