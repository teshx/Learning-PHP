<?php
session_start();
require_once '../../../../config/db.php';
require_once '../controllers/AuthorController.php';

// Initialize database and controller
$database = new Database();
$db = $database->connect();
$controller = new AuthorController($db);

// Handle deletion
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    if ($controller->deleteAuthor($id)) {
        $_SESSION['delmsg'] = "Author deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting author";
    }
    header('location:manage-authors.php');
    exit;
}

// Get all authors
$authors = $controller->getAllAuthors();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Authors</title>
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h4 {
            margin-bottom: 20px;
            color: #333;
            font-size: 1.8em;
            text-align: center;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
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

        .filter-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .filter-container input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background-color: #007bff;
            color: white;
        }

        table th,
        table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 8px 12px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        @media screen and (max-width: 768px) {

            table th,
            table td {
                font-size: 14px;
                padding: 8px;
            }

            .btn {
                padding: 6px 8px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <?php include('../includes/header.php'); ?>
    <div class="container">
        <h4>Manage Authors</h4>

        <!-- Messages -->
        <?php if (isset($_SESSION['delmsg'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['delmsg'];
                unset($_SESSION['delmsg']); ?>
            </div>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Filter Input -->
        <div class="filter-container">
            <input type="text" id="filterInput" placeholder="Search authors...">
        </div>

        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Author Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="authorTable">
                <?php if ($authors): ?>
                    <?php foreach ($authors as $index => $author): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($author->name); ?></td>
                            <td>
                                <a href="edit_authore.php?authorid=<?php echo $author->id; ?>" class="btn btn-primary">Edit</a>
                                <a href="manage-authors.php?del=<?php echo $author->id; ?>"
                                    class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No authors found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('filterInput').addEventListener('keyup', function() {
            const filterValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#authorTable tr');

            rows.forEach(row => {
                const authorName = row.cells[1].textContent.toLowerCase();
                if (authorName.includes(filterValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>