<?php
session_start();

// Check if a role exists in the session
if (isset($_SESSION['role'])) {
    // Redirect based on role
    if ($_SESSION['role'] === 'Admin') {
        header("Location: ./dashbords/admin/admin.php");
        exit;
    } elseif ($_SESSION['role'] === 'Librarian') {
        header("Location: ./dashbords/liberaryan/liberaryan.php");
        exit;
    } elseif ($_SESSION['role'] === 'Member') {
        header("Location: ./dashbords/student/student.php");
        exit;
    } elseif ($_SESSION['role'] === 'Visitor') {
        header("Location: ./dashbords/visitor/visitor.php");
        exit;
    } else {
        // If an invalid role is set, clear the session and redirect to login
        session_unset();
        session_destroy();
        header("Location: ./login.php");
        exit;
    }
} else {
    // If no session role exists, show the login form
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="./assets/styles.css">
    </head>

    <body>
        <div class="login-container">
            <img src="./assets/logo.png" alt="Login">
            <h2>Login to Your Account</h2>
            <form method="POST" action="../routes/routes.php?action=login">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <p><a href="../routes/routes.php?action=register">Forgot Password?</a></p>
        </div>
    </body>

    </html>
<?php
}
?>