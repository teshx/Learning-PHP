<?php
session_start();
require_once '../../../../config/db.php';
require_once '../controllers/manageBookController.php';

// Initialize database and controller
$database = new Database();
$db = $database->connect();
$controller = new BookController($db);

// Handle deletion
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    if ($controller->deleteBook($id)) {
        $_SESSION['delmsg'] = "Book deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting book";
    }
    header('location:manage-books.php');
    exit;
}

// Get all books
$books = $controller->getAllBooks();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/styless.css">
</head>

<body>
    <header> <?php include('../includes/header.php'); ?></header>
    <div class="container">

        <h4>Manage Books</h4>

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
            <input type="text" id="filterInput" placeholder="Search books...">
        </div>

        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Book Name</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($books): ?>
                    <?php $cnt = 1; ?>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td class="center"><?php echo htmlentities($cnt); ?></td>
                            <td class="center" width="300">
                                <img src="../assets/bookImages/<?php echo htmlentities($book['image']); ?>" width="100">
                                <br /><b><?php echo htmlentities($book['name']); ?></b>
                            </td>
                            <td class="center"><?php echo htmlentities($book['category']); ?></td>
                            <td class="center"><?php echo htmlentities($book['author']); ?></td>
                            <td class="center"><?php echo htmlentities($book['ISBNnumber']); ?></td>
                            <td class="center"><?php echo htmlentities($book['price']); ?></td>
                            <td class="center">
                                <a href="edit-book.php?bookid=<?php echo $book['id']; ?>" class="btn btn-primary">Edit</a>
                                <a href="manage-books.php?del=<?php echo $book['id']; ?>"
                                    class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                            </td>
                        </tr>
                        <?php $cnt++; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center;">No books found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('filterInput').addEventListener('keyup', function() {
            const filterValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');

            rows.forEach(row => {
                const bookName = row.cells[1].textContent.toLowerCase(); // Column 1 is book name
                if (bookName.includes(filterValue)) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });
        });
    </script>

</body>

</html>