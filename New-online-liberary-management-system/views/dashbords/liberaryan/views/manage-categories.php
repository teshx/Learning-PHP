<?php
session_start();
require_once '../../../../config/db.php';
require_once '../controllers/manageController.php';

// Initialize database and controller
$database = new Database();
$db = $database->connect();
$controller = new CategoryController($db);

// Handle deletion
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    if ($controller->deleteCategory($id)) {
        $_SESSION['delmsg'] = "Category deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting category";
    }
    header('location:manage-categories.php');
    exit;
}

// Get all categories
$categories = $controller->getAllCategories();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/styless.css">

</head>

<body>
    <?php include('../includes/header.php'); ?>
    <div class="container">

        <h4>Manage Categories</h4>

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
            <input type="text" id="filterInput" placeholder="Search categories...">
        </div>

        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($categories): ?>
                    <?php foreach ($categories as $index => $category): ?>
                        <tr>
                            <td data-label="#"> <?php echo $index + 1; ?> </td>
                            <td data-label="Category Name"> <?php echo htmlspecialchars($category->name); ?> </td>
                            <td data-label="Status">
                                <span class="badge <?php echo $category->status ? 'active' : 'inactive'; ?>">
                                    <?php echo $category->status ? 'Active' : 'Inactive'; ?>
                                </span>
                            </td>
                            <td data-label="Actions">
                                <a href="edit-category.php?catid=<?php echo $category->id; ?>" class="btn btn-primary">Edit</a>
                                <a href="manage-categories.php?del=<?php echo $category->id; ?>"
                                    class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">No categories found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('filterInput').addEventListener('keyup', function() {
            const filterValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr'); // Correct selector

            rows.forEach(row => {
                const categoryName = row.cells[1].textContent.toLowerCase(); // Column 1 is category name
                if (categoryName.includes(filterValue)) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });
        });
    </script>

</body>

</html>