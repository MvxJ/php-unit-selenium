<?php

namespace Tests\traits;

trait DatabaseTrait
{
    protected static $dbConnection;

    /**
     * @beforeClass
     */
    public function createDatabase(): void
    {
        if (self::$dbConnection) return;

        self::$dbConnection = new \PDO('sqlite::database.db');
    }

    /**
     * @afterClass
     */
    public function deleteDatabase(): void
    {
        self::$dbConnection = null;
        unlink('database.db');
    }
}