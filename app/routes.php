<?php

use App\Controllers\FirstController;

$app->get('/hello/{name}', FirstController::class.':home');
//$app->post('/hello/{name}', FirstController::class.':home');