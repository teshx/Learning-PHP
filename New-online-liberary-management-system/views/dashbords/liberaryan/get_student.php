<?php
require_once '../../../config/db.php';

// Initialize the database connection
$db = new Database();
$dbh = $db->connect();

if (isset($_POST['studentid'])) {
    $studentid = $_POST['studentid'];

    try {
        // Prepare and execute the query
        $stmt = $dbh->prepare("SELECT * FROM users WHERE username = :studentid");
        $stmt->bindParam(':studentid', $studentid, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the student details
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            // Display student details
            echo "Name: " . $student['fullname'] . "<br>";
            echo "ID: " . $student['username'] . "<br>";
            echo "Role: " . $student['role'];
        } else {
            echo "Student not found";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
