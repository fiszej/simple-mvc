<?php
declare(strict_types=1);

return [
    'dsn' => 'mysql:host=localhost;dbname=mvc',
    'username' => 'root',
    'password' => '',
    'options'  => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
];
