<?php
include '../config/db.php'; // Database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <div class="container">
        <form action="../controllers/authController.php" method="POST">
            <h1>Forgot Password</h1>
            <p>Enter your email to reset your password.</p>
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit" name="forgot_password">Reset Password</button>
        </form>
    </div>
</body>

</html>