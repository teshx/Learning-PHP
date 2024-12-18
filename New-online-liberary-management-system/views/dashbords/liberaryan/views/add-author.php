<?php
session_start();
require_once '../../../../config/db.php';
require_once '../controllers/addAuthorController.php';

// Initialize database and controller
$database = new Database();
$db = $database->connect();
$controller = new AuthorController($db);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_author'])) {
    $name = trim($_POST['name']);

    if (!empty($name)) {
        if ($controller->createAuthor($name)) {
            $_SESSION['success'] = "Author added successfully.";
        } else {
            $_SESSION['error'] = "Error adding author.";
        }
    } else {
        $_SESSION['error'] = "Author name cannot be empty.";
    }
    header('location:manage-authors.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Author</title>
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <?php include('../includes/header.php'); ?>
    <div class="container">
        <h4>Add Author</h4>

        <!-- Display success/error messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Add Author Form -->
        <form method="POST" action="add-author.php">
            <input type="text" name="name" placeholder="Enter author name" required>
            <button type="submit" name="add_author">Add Author</button>
        </form>
    </div>
</body>

</html>