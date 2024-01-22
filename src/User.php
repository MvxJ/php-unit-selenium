<?php

namespace App;

class Database {
    /**
     * @codeCoverageIgnore
     */
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

    public function someOperation($array)
    {
        $count = count($array);

        if ($count == 0) {
            return 'error';
        } elseif ($count == 1 && $array[0] == 0) {
            return 'error';
        } else {
            return 'ok';
        }
    }

    protected function hashPassword()
    {
        return 'password hash';
    }
}