<?php
session_start();
require_once '../../../../config/db.php';

require_once '../controllers/UserController.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Initialize database and controller
$database = new Database();
$db = $database->connect();
$userController = new UserController($db);

// Fetch the user's profile
$userId = $_SESSION['user_id'];
$user = $userController->editProfile($userId);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    if ($userController->updateProfile($userId, $username, $email, $password)) {
        $_SESSION['msg'] = "Profile updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update profile.";
    }
    header('Location: edit-profile.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

      

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        form button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        form button:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
            font-size: 16px;
        }

        p[style="color: green;"] {
            color: #4CAF50;
            font-weight: bold;
        }

        p[style="color: red;"] {
            color: #f44336;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <?php include('../includes/headers.php'); ?>
    </header>


    <?php if (isset($_SESSION['msg'])): ?>
        <p style="color: green;"><?php echo $_SESSION['msg'];
                                    unset($_SESSION['msg']); ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error'];
                                unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <h2>Edit Profile</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <br><br>

        <label for="password">Password (Leave blank to keep current):</label>
        <input type="password" id="password" name="password">
        <br><br>

        <button type="submit">Update Profile</button>
    </form>
</body>

</html>