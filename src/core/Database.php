<?php
declare(strict_types=1);

namespace app\src\core;

use \PDO;

class Database
{
    public $pdo;

    public function __construct($config)
    {
        $this-> pdo = new PDO(
            $config['dsn'],
            $config['username'],
            $config['password'],
            $config['options']
        );
    }
}