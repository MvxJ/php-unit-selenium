<?php

use Slim\Views\PhpRenderer;
use Illuminate\Database\Capsule\Manager;

$container = $app->getContainer();

$container->set('view', new PhpRenderer('../app/Views/', ['baseUrl' => 'http://localhost:8000/']));

$container->set('my-service', function ($c) {
    return 'My Service Injection';
});