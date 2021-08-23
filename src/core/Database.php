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
            $config['password']
        );
    }

    public function findOneById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }

}