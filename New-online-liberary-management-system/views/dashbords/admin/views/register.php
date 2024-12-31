<?php
// session_start();

require_once __DIR__ . '/../../../../middlewares/authMiddleware.php';
checkRole('Admin');

require_once '../../../../config/db.php';
require_once '../models/User.php';
require_once '../controllers/UserController.php';

$database = new Database();
$db = $database->connect();
$userModel = new UserModel($db);
$userController = new UserController($userModel);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['username'];
    $role = $_POST['role'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $userController->registerUser($username, $password, $role, $fullname, $email);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Registration</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            min-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555555;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            outline: none;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>
    <header><?php include('../includess/header.php'); ?></header>
    <div class="container">
        <h2>User Registration</h2>

        <?php if (isset($_SESSION['msg'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['msg'];
                                                unset($_SESSION['msg']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error'];
                                            unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="fullname" class="form-control" required>
            </div>
            <div class="form-group">
                <label>user ID</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <!-- <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div> -->
            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="">--Select Role--</option>
                    <option value="admin">Admin</option>
                    <option value="librarian">Librarian</option>
                    <option value="Member">Student</option>
                    <option value="Member">Teacher</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
    <!-- <?php include('../includes/footer.php'); ?> -->
</body>

</html>