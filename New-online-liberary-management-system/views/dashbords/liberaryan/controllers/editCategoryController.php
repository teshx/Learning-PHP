<?php
session_start();
require_once '../../../../config/db.php'; // Include the Database class
require_once '../models/editCategory.php';

// Check if the user is logged in
if (strlen($_SESSION['alogin']) == 0) {
    header('location:../../index.php');
    exit;
}

// Create a new Database object and connect
$database = new Database();
$dbh = $database->connect(); // Get the PDO connection object

// Ensure the database connection is established
if (!$dbh) {
    die("Database connection not established. Please check 'db.php'.");
}

// Instantiate the Category model and pass $dbh
$categoryModel = new Category($dbh);

// Fetch category details if `catid` is set
if (isset($_GET['catid'])) {
    $catid = intval($_GET['catid']); // Convert to integer
    $category = $categoryModel->getCategoryById($catid);

    if (!$category) {
        $_SESSION['error'] = "Category not found.";
        header('location:../views/manage-categories.php');
        exit;
    }
}

// Handle form submission for updating category
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['category']); // Get category name
    $status = intval($_POST['status']); // Get status (1 or 0)
    $catid = intval($_POST['catid']); // Get category ID from the hidden input

    if ($categoryModel->updateCategory($catid, $name, $status)) {
        $_SESSION['success'] = "Category updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update category.";
    }

    header('location:../views/manage-categories.php');
    exit;
}
