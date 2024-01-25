<?php

use Illuminate\Database\Capsule\Manager;
use App\Models\Category;

//$container->set('db', function ($container) {
$capsule = new Manager();
$capsule->addConnection($container->get('settings')['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

//    return $capsule;
//});

$container->view->addAtribute('categories', Category::all());