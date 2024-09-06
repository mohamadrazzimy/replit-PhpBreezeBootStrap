<?php

// Database connection settings
$dsn = 'sqlite:../db/database.sqlite';

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn);

    // Enable exceptions for errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get table structure
    $structureQuery = "PRAGMA table_info(users)";
    $structureStmt = $pdo->query($structureQuery);
    $tableStructure = $structureStmt->fetchAll(PDO::FETCH_ASSOC);

    // Get table records
    $recordsQuery = "SELECT * FROM users";
    $recordsStmt = $pdo->query($recordsQuery);
    $tableRecords = $recordsStmt->fetchAll(PDO::FETCH_ASSOC);

    // Display table structure
    echo "Table Structure:\n";
    foreach ($tableStructure as $column) {
        echo "Column Name: {$column['name']}\n";
        echo "Data Type: {$column['type']}\n";
        echo "Nullable: " . ($column['notnull'] ? 'No' : 'Yes') . "\n";
        echo "Default Value: {$column['dflt_value']}\n";
        echo "------------------------\n";
    }

    // Display table records
    echo "Table Records:\n";
    foreach ($tableRecords as $record) {
        echo "ID: {$record['id']}\n";
        echo "Username: {$record['username']}\n";
        echo "Password: {$record['password']}\n";
        echo "Email: {$record['email']}\n";
        echo "------------------------\n";
    }
} catch (PDOException $e) {
    echo "Error viewing users table: " . $e->getMessage();
}