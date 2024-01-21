<?php

namespace App;

class Database {
    public function getEmailAndLastName()
    {
        echo 'real database fetch';
    }
}

class User
{
    private $name;
    protected $lastName;
    private $database;

    public function __construct($name, $lastName)
    {
        $this->name = ucfirst($name);
        $this->lastName = ucfirst($lastName);
        $this->database = new Database();
    }

    public function getFullName(): string
    {
        $this->database->getEmailAndLastName();

        return $this->name . ' ' . $this->lastName;
    }

    protected function hashPassword()
    {
        return 'password hash';
    }
}