<?php

use Illuminate\Database\Capsule\Manager;
use App\Models\Category;
use App\Services\CategoryFactory;

//$container->set('db', function ($container) {
$capsule = new Manager();
$capsule->addConnection($container->get('settings')['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

//    return $capsule;
//});
$view = $container->get('view');
$view->addAttribute('categories', CategoryFactory::create());
$container->set('view', $view);