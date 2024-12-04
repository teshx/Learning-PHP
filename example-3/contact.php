<?php
require "../php-examples-2/connect.php"; 
// Ensure connect.php establishes a connection and assigns it to $link

$firstName = "";
$lastName = "";
$message = "";
$errors = [];

// Capture the submitted values and validate them
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST['fname'])) {
        $errors[] = "First name is required.";
    } else {
        $firstName = trim($_POST['fname']);
    }

    if (empty($_POST['lname'])) {
        $errors[] = "Last name is required.";
    } else {
        $lastName = trim($_POST['lname']);
    }

    if (empty($_POST['contactMessage'])) {
        $errors[] = "Message is required.";
    } else {
        $message = trim($_POST['contactMessage']);
    }

    // If no errors, proceed with database insertion
    if (empty($errors)) {
        $sql = "INSERT INTO contactmessage (first_name, last_name, message_sent) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $firstName, $lastName, $message);

            if (mysqli_stmt_execute($stmt)) {
                echo "Message saved successfully.";
            } else {
                echo "ERROR: Could not execute the query. " . mysqli_error($link);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "ERROR: Could not prepare the query. " . mysqli_error($link);
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}

mysqli_close($link);
