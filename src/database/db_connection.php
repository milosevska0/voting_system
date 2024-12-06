<?php
try {
    $dsn = 'sqlite:' . __DIR__ . '/db.sqlite';
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = file_get_contents(__DIR__ . '/db_schema.sql');
    $pdo->exec($sql);

    echo "Database initialized successfully.";

} catch (PDOException $e) {
    die("Connection with db failed: " . $e->getMessage());
}
