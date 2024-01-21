<?php

namespace Tests;

use App\Database;
use App\User;
use PHPUnit\Framework\TestCase;
use Tests\traits\CustomAssertionTrait;

class UserTest extends TestCase
{
    use CustomAssertionTrait;

    public function testValidUserName()
    {
        $user = new User('john', 'Doe');
        $expected = 'John';
        $phpUnit = $this;

        $closure = function () use ($phpUnit, $expected) {
            $phpUnit->assertSame($expected, $this->name);
        };

        $binding = $closure->bindTo($user, get_class($user));
        $binding();
    }

    public function testValidUserLastName()
    {
        $user = new Class('john', 'Doe') extends User {
            public function getLastName()
            {
                return $this->lastName;
            }
        };

        $expected = 'Doe';

        $this->assertSame($expected, $user->getLastName());
    }

    public function testValidDataFormat()
    {
        $user = new User('john', 'doe');
        $mockDatabase = new class extends Database {
            public function getEmailAndLastName()
            {
            }
        };

        $setUserClosure = function () use ($mockDatabase) {
            $this->database = $mockDatabase;
        };

        $executeSetUserClosure = $setUserClosure->bindTo($user, get_class($user));
        $executeSetUserClosure();

        $this->assertSame('John Doe', $user->getFullName());
    }

    public function testPasswordHash()
    {
        $user = new User('john', 'doe');
        $expected = 'password hash';
        $phpUnit = $this;

        $assertClosure = function () use ($phpUnit, $expected) {
            $phpUnit->assertSame($expected, $this->hashPassword());
        };

       $executeAssertClosure = $assertClosure->bindTo($user, get_class($user));
       $executeAssertClosure();
    }

    public function testPasswordHashAnonymous()
    {
        $user = new class('john', 'doe') extends User {
            public function getHashedPassword()
            {
                return $this->hashPassword();
            }
        };
        $expected = 'password hash';

        $this->assertSame($expected, $user->getHashedPassword());
    }

    public function testCustomDataStructure()
    {
        $data = [
            'nick' => 'dollar',
            'email' => 'john@doe.com',
            'age' => 70
        ];

        $this->assertArrayData($data);
    }
}