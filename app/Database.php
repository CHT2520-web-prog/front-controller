<?php
namespace App;
use PDO;

class Database {
    private PDO $conn;

    public function __construct(string $host, string $dbname, string $user, string $pass)
    {
        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";

        $this->conn = new PDO(
            $dsn,
            $user,
            $pass,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}
