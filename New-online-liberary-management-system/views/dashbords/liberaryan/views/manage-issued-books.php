<?php
session_start();
require_once '../../../../config/db.php';
require_once '../controllers/ManageIssueController.php';

// Initialize database and controller
$database = new Database();
$db = $database->connect();
$controller = new IssuedBookController($db);

// Handle deletion
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    if ($controller->deleteIssuedBook($id)) {
        $_SESSION['msg'] = "Record deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting record";
    }
    header('location: manage-issued-books.php');
    exit;
}

// Fetch issued books
$result = $controller->getAllIssuedBooks();
$issuedBooks = $result->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Issued Books</title>
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            margin: 20px auto;
            max-width: 1200px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        h4 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        .btn {
            padding: 6px 10px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .filter-container input {
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .alert {
            margin-bottom: 20px;
            padding: 10px;
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
    <div class="container">
        <h4>Manage Issued Books</h4>

        <!-- Messages -->
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['msg'];
                                                unset($_SESSION['msg']); ?></div>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error'];
                                            unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <!-- Filter Input -->
        <div class="filter-container">
            <input type="text" id="filterInput" placeholder="Search by ISBN or Username...">
        </div>

        <!-- Table -->
        <table id="issuedBooksTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ISBN</th>
                    <th>Username</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Fine</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($issuedBooks): ?>
                    <?php foreach ($issuedBooks as $index => $book): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($book->isbn); ?></td>
                            <td><?php echo htmlspecialchars($book->username); ?></td>
                            <td><?php echo $book->issue_date; ?></td>
                            <td><?php echo $book->return_date; ?></td>
                            <td><?php echo $book->status; ?></td>
                            <td><?php echo $book->fine; ?></td>
                            <td>
                                <a href="edit-issued-book.php?id=<?php echo $book->id; ?>" class="btn btn-primary">Edit</a>
                                <a href="manage-issued-books.php?del=<?php echo $book->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No issued books found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Filter Functionality
        document.getElementById('filterInput').addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#issuedBooksTable tbody tr');

            rows.forEach(row => {
                const isbn = row.cells[1].textContent.toLowerCase();
                const username = row.cells[2].textContent.toLowerCase();

                if (isbn.includes(filter) || username.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>