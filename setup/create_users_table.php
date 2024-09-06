<?php

// Database connection settings
$dsn = 'sqlite:../db/database.sqlite';

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn);

    // Enable exceptions for errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the users table
    $query = "CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT NOT NULL,
                password TEXT NOT NULL,
                email TEXT NOT NULL
            )";
    $pdo->exec($query);

    echo "Users table created successfully.". "\n";
} catch (PDOException $e) {
    echo "Error creating users table: " . $e->getMessage(). "\n";
}