<?php

namespace App\Database;

use PDO;

class Db
{
    private static ?Db $instance = null;

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO($_ENV['DB_TYPE'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'].';port='.$_ENV['DB_PORT'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    }

    public static function pdo(): PDO
    {
        return self::getInstance()->pdo;
    }

    public static function query(string $query): array
    {
        $query = self::pdo()->query($query);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function prepare(string $query, array $arguments = []): array
    {
         $query = self::pdo()->prepare($query);
         $query->execute($arguments);

         return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    private static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}