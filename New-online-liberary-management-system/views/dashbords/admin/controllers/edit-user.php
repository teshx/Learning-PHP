<?php
// session_start();
require_once '../../../../config/db.php';
require_once '../models/edit-reg.php';

// Initialize database and model
$database = new Database();
$db = $database->connect();
$model = new ManageRegistration($db);

// Check if user ID is set
if (isset($_GET['userid'])) {
    $id = intval($_GET['userid']);
    $user = $model->getUserById($id); // Fetch the user data to populate the form
} else {
    $_SESSION['error'] = "User not found.";
    header('Location: manage-register.php');
    exit;
}

// Handle the update operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $status = $_POST['status'];
    $role = $_POST['role'];

    // Validate input
    if (empty($username) || empty($email) || empty($fullname) || empty($role) || empty($role)) {
        $_SESSION['error'] = "All fields are required.";
    } else {
        if ($model->updateUser($id, $username, $email, $fullname, $status, $role)) {
            $_SESSION['success'] = "User updated successfully.";
            header('Location: manage-register.php');
            exit;
        } else {
            $_SESSION['error'] = "Error updating user. or email";
        }
    }
}
