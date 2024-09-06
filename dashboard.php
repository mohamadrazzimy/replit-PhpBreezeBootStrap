<?php
// Include the database connection file
require_once 'dbconn.php';

// Check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Retrieve the user information
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="d-flex justify-content-center">
        <div class="max-w-md w-100 mx-auto p-4 mt-5">
            <h1 class="text-3xl font-semibold mb-4">Dashboard</h1>
            <div class="bg-white shadow-md rounded p-4 mb-4">
                <p class="text-muted">Welcome, <?php echo $user['username']; ?>!</p>
                <p>Email: <?php echo $user['email']; ?></p>
                <p class="text-muted mt-2">You are logged into the dashboard.</p>
                <br/>
                <a class="mt-4 btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>