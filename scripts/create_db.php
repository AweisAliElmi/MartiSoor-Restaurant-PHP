<?php
// scripts/create_db.php
$host = 'localhost';
$port = '5432';
$user = 'postgres';
$pass = '123';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=postgres", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if database exists
    $stmt = $pdo->prepare("SELECT 1 FROM pg_database WHERE datname = 'restaurant_db'");
    $stmt->execute();
    
    if (!$stmt->fetch()) {
        $pdo->exec("CREATE DATABASE restaurant_db");
        echo "Database 'restaurant_db' created successfully.\n";
    } else {
        echo "Database 'restaurant_db' already exists.\n";
    }
} catch (PDOException $e) {
    die("Error creating database: " . $e->getMessage());
}
