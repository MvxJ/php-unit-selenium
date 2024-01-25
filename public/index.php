<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;

require '../vendor/autoload.php';

$config = require '../app/config.php';
$container = new Container();
$container->set('settings', $config);

AppFactory::setSlimHttpDecoratorsAutomaticDetection(false);
AppFactory::setContainer($container);
ServerRequestCreatorFactory::setSlimHttpDecoratorsAutomaticDetection(false);

$app = AppFactory::create();

require '../app/dependencies.php';
$config = require '../app/bootstrap.php';
require '../app/routes.php';

$app->run();