<?php
session_start();
require_once '../../../../config/db.php';
require_once '../models/CategoryModel.php';
require_once '../controllers/CategoryController.php';

$database = new Database();
$db = $database->connect();
$categoryModel = new CategoryModel($db);
$categoryController = new CategoryController($categoryModel);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['category'];
    $status = $_POST['status'];
    $categoryController->createCategory($name, $status);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Category</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>
    <?php include('../includes/header.php'); ?>
    <div class="container">
        <h2>Add Category</h2>
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
                <label>Category Name</label>
                <input type="text" name="category" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <div>
                    <label><input type="radio" name="status" value="1" checked> Active</label>
                    <label><input type="radio" name="status" value="0"> Inactive</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
    <!-- <?php include('../includes/footer.php'); ?> -->
</body>

</html>