<?php

require_once '../../../../config/db.php';
require_once '../models/manage-reg.php';

// Initialize database and model
$database = new Database();
$db = $database->connect();
$model = new ManageRegistration($db);

// Handle deletion
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    if ($model->deleteUser($id)) {
        $_SESSION['delmsg'] = "User deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting user";
    }
    header('location:manage-register.php');
    exit;
}

// Get all users
$users = $model->getAllUsers();
