<?php
session_start();

// Check if a role exists in the session
if (isset($_SESSION['role'])) {
    // Redirect based on role
    if ($_SESSION['role'] === 'Admin') {
        header("Location: ./dashbords/admin/admin.php");
        exit;
    } elseif ($_SESSION['role'] === 'Librarian') {
        header("Location: ./dashbords/liberaryan/liberaryan.php");
        exit;
    } elseif ($_SESSION['role'] === 'Member') {
        header("Location: ./dashbords/student/student.php");
        exit;
    } elseif ($_SESSION['role'] === 'Visitor') {
        header("Location: ./dashbords/visitor/visitor.php");
        exit;
    } else {
        // If an invalid role is set, clear the session and redirect to login
        session_unset();
        session_destroy();
        header("Location: ./login.php");
        exit;
    }
} else {

    header("Location: ./login.php");
    exit;
}
