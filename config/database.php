<?php
// config/database.php

define('DB_HOST', 'localhost');
define('DB_PORT', '5432');
define('DB_NAME', 'restaurant_db'); // Database name
define('DB_USER', 'postgres');      // Username
define('DB_PASS', '123');      // Password

function get_db_connection() {
    $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
