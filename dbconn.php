<?php
// SQLite database file path
$databasePath = 'db/database.sqlite';

try {
    // Create a new PDO instance
    $pdo = new PDO('sqlite:' . $databasePath);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set PDO fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Enable foreign key constraints (optional)
    $pdo->exec('PRAGMA foreign_keys = ON;');
} catch (PDOException $e) {
    // Display an error message if the connection fails
    die('Connection failed: ' . $e->getMessage());
}