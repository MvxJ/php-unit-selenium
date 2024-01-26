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
            $table->text('description')->nullable(false);
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Category::create([
            'name' => 'Electronics',
            'description' => 'description of electronics'
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

    public function testCanAddChildCategory()
    {
        $parentCategory = Category::where('name', 'Electronics')->first();
        $parentCategory->children()->saveMany([
            new Category(['name' => 'Monitors', 'description' => 'description of monitors']),
            new Category(['name' => 'Tablets', 'description' => 'description of tablets']),
            new Category(['name' => 'Computers', 'description' => 'description of computers']),
        ]);

        $computers = Category::where('name', 'Computers')->first();
        $computers->children->saveMany([
            new Category(['name' => 'Desktops', 'description' => 'description of desktops']),
            new Category(['name' => 'Notebooks', 'description' => 'description of notebooks']),
            new Category(['name' => 'Laptops', 'description' => 'description of laptops']),
        ]);

        $computers = Category::where('name', 'Laptops')->first();
        $computers->children->saveMany([
            new Category(['name' => 'Asus', 'description' => 'description of asus']),
            new Category(['name' => 'Dell', 'description' => 'description of dell']),
            new Category(['name' => 'Acer', 'description' => 'description of acer']),
        ]);

        $computers = Category::where('name', 'Acer')->first();
        $computers->children->saveMany([
            new Category(['name' => 'FullHD', 'description' => 'description of fullHD']),
            new Category(['name' => 'HD+', 'description' => 'description of HD+']),
        ]);

        Category::create([
            'name' => 'Videos',
            'description' => 'description of videos'
        ]);

        Category::create([
            'name' => 'Software',
            'description' => 'description of software'
        ]);

        $software = Category::where('name', 'Software')->first();
        $software->children->saveMany([
            new Category(['name' => 'Operating Systems', 'description' => 'description of systems']),
            new Category(['name' => 'Servers', 'description' => 'description of servers']),
        ]);

        $software = Category::where('name', 'Operating Systems')->first();
        $software->children->saveMany([
            new Category(['name' => 'Linux', 'description' => 'description of linux']),
        ]);
    }
}