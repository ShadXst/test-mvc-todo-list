<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

return [
    'isDevMode' => $_ENV['IS_DEV_MODE'] === 'true',
    'modelsPath' => __DIR__ . '/../app/Models',
    'admin' => [
        'login' => $_ENV['ADMIN_LOGIN'],
        'password' => $_ENV['ADMIN_PASSWORD'],
    ],
    'database' => [
        'driver'   => $_ENV['DB_DRIVER'],
        'dbname'   => $_ENV['DB_NAME'],
        'user'     => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASS'],
    ],
];
