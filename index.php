<?php

require './vendor/autoload.php';

use app\src\App;
use app\src\controllers\SiteController;

$app = New App(__DIR__);

$app->route->get('/', 'home');


$app->route->get('/register', [SiteController::class, 'register']);

$app->runForest();