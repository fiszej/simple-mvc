<?php

require './vendor/autoload.php';

use app\src\core\App;
use app\src\controllers\SiteController;

$config = require __DIR__.'/config.php';

$app = new App(__DIR__, $config);
$app->route->get('/', 'home');

$app->route->post('/create', [SiteController::class, 'create']);

$app->route->get('/register', [SiteController::class, 'register']);
$app->route->get('/show', [SiteController::class, 'show']);

$app->runForest();