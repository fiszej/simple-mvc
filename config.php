<?php
declare(strict_types=1);

return [
    'dsn' => 'mysql:host=localhost;dbname=mvc',
    'username' => 'phpmyadmin',
    'password' => 'Magazyn#!01',
    'options'  => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
];