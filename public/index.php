<?php

require dirname(__DIR__, 1).'/vendor/autoload.php';

use app\src\controllers\AuthController;
use app\src\core\App;
use app\src\controllers\SiteController;

$config = require __DIR__.'./../config.php';

$app = new App(dirname(__DIR__, 1), $config);

//Site actions
$app->route->get('/', [SiteController::class, 'index']);
$app->route->get('/register', [SiteController::class, 'register']);
$app->route->get('/login', [SiteController::class, 'login']);
$app->route->get('/profile', [SiteController::class, 'profile']);
$app->route->get('/update', [AuthController::class, 'update']);

// Register & login action
$app->route->post('/create', [AuthController::class, 'register']);
$app->route->post('/login', [AuthController::class, 'login']);
$app->route->get('/logout', [AuthController::class, 'logout']);

$app->runForest();

