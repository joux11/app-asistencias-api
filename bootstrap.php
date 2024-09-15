<?php

require_once __DIR__ . '/vendor/autoload.php'; // Cargar autoload de Composer


use Illuminate\Database\Capsule\Manager as Capsule;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => env('DB_DRIVER'),
    'host'      => env('DB_HOST'),
    'database'  => env('DB_DATABASE'),
    'username'  => env('DB_USERNAME'),
    'password'  => env('DB_PASSWORD'),
    'charset'   => env('DB_CHARSET'),
    'collation' => env('DB_COLLATION'),
    'prefix'    => env('DB_PREFIX'),
]);

// Hace que Eloquent esté disponible de forma global
$capsule->setAsGlobal();

// Inicializa Eloquent
$capsule->bootEloquent();
