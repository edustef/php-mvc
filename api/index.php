<?php
ini_set('display_errors', 'on');

require_once __DIR__ . '/vendor/autoload.php';

use app\controllers\SiteController;
use app\models\User;
use edustef\mvcFrame\Application;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
  'userClass' => User::class,
  'db' => [
    'dsn' => $_ENV['DB_DSN'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD']
  ],
  'title' => 'Demo App'
];

$app = new Application(__DIR__ . '/src/', $config);

$app->router->add('/', [SiteController::class, 'home']);

$app->run();