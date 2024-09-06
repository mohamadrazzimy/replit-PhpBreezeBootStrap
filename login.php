<?php
// Include the database connection file
require_once 'dbconn.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve the user from the database
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, start a session and redirect to the dashboard
        session_start();
        $_SESSION['user_id'] = $user['id'];

        // Set the username in a session variable
        $_SESSION['username'] = $username; // $username is the logged-in user's username or name

        header('Location: dashboard.php');
        exit();
    } else {
        // Invalid login credentials
        $error = 'Invalid email or password';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="d-flex align-items-center justify-content-center min-vh-100">
        <div class="max-w-md w-100 mx-auto p-4">
            <h1 class="text-3xl font-semibold mb-4">Login</h1>
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="">
                <div class="mb-3">
                    <label class="form-label" for="email">Email:</label>
                    <input class="form-control" type="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password:</label>
                    <input class="form-control" type="password" name="password" required>
                </div>
                <?php if (isset($error)) : ?>
                    <p class="text-danger mb-3"><?php echo $error; ?></p>
                <?php endif; ?>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>