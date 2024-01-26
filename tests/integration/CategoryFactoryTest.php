<?php

use App\Services\CategoryFactory;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;
use PHPUnit\Framework\TestCase;

class CategoryFactoryTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        $capsule = new Manager();
        $capsule->addConnection([
            'driver' => 'sqlite',
            'host' => 'localhost',
            'database' => '/home/mjachymczak/sites/php-unit-selenium/app/database/db.sqlite',
            'username' =>'user',
            'password' => 'password',
            'charset' => 'utf8',
            'collation' =>'utf8_unicode_ci',
            'prefix' => ''
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $capsule::schema()->dropIfExists('categories');
        $capsule::schema()->create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false);
            $table->bigInteger('parent_id')->unsigned()->nullable();
        });
    }

    public function testCanProductStringBaseOnArray()
    {
        $this->assertTrue(is_array(CategoryFactory::create()['selectListCategories']));
    }
}