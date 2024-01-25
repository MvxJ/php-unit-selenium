<?php

namespace tests\acceptance;

use App\Models\Category;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;
use PHPUnit\Extensions\Selenium2TestCase;

class BackendStuffTest extends Selenium2TestCase
{
    public static function setUpBeforeClass(): void
    {
        $capsule = new Manager();
        $capsule->addConnection([
            'driver' => 'sqlite',
            'host' => 'localhost',
            'database' => '/home/mvxj/sites/php-unit-selenium/database/db.sqlite',
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

        Category::create([
            'name' => 'Electronics'
        ]);
//        $capsule::table('electronics')->insert(
//            ['name' => 'Electronics']
//        );
    }

    public function setUp(): void
    {
        $this->setBrowser('http://localhost:8000');
        $this->setBrowser('chrome');
        $this->setDesiredCapabilities(['chromeOptions' => ['w3c' => false]]);
    }

    public function testCAnSeeCorrectStringOnMainPage()
    {
        $this->url('');
        $this->assertStringContainsString('Electronics', $this->source());
    }
}