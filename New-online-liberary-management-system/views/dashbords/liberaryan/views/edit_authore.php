<?php
session_start();
require_once '../../../../config/db.php';
require_once '../controllers/editAuthorcontrol.php';

// Initialize database and controller
$database = new Database();
$db = $database->connect();
$controller = new AuthorController($db);

// Fetch author details
$author = null;
if (isset($_GET['authorid'])) {
    $authorid = intval($_GET['authorid']);
    $author = $controller->getAuthor($authorid);
    if (!$author) {
        $_SESSION['error'] = "Author not found.";
        header('location:manage-authors.php');
        exit();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $authorid = intval($_POST['authorid']);
    $authorName = trim($_POST['author']);
    if ($controller->updateAuthor($authorid, $authorName)) {
        $_SESSION['success'] = "Author updated successfully.";
        header('location:manage-authors.php');
        exit();
    } else {
        $_SESSION['error'] = "Failed to update author.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author</title>
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h4 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <header> <?php include('../includes/header.php'); ?></header>

    <div class="container">
        <h4>Edit Author</h4>
        <form method="POST">
            <input type="hidden" name="authorid" value="<?php echo $author->id; ?>">
            <label for="author">Author Name:</label>
            <input type="text" name="author" id="author" value="<?php echo htmlspecialchars($author->name); ?>" required>
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>

</html>