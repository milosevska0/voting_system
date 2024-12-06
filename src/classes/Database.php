<?php

class Database {
    private $pdo;

    public function __construct()
    {
        try {
            $dsn = 'sqlite:' . __DIR__ . '/../database/db.sqlite';
            $this->pdo = new PDO($dsn);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Connection with db failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}