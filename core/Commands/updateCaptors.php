<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createMutable(__DIR__ . '/../../');
$dotenv->load();

use app\core\Application;
use app\models\Capteur;

$config = [
    'db' => [
        'dsn' => "mysql:host={$_ENV['DATABASE_HOST']};dbname={$_ENV['DATABASE_NAME']};port={$_ENV['DATABASE_PORT']}",
        'user' => $_ENV['DATABASE_USER'],
        'password' => $_ENV['DATABASE_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$capteurModel = new Capteur;

$capteurModel->saveData();
$capteurModel->saveMinMaxValues();
