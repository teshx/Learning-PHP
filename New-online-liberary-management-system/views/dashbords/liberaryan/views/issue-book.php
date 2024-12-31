<?php
session_start();
error_reporting(0);
require_once '../../../../config/db.php';
include('../controllers/IssueBookController.php');


$database = new Database();
$dbh = $database->connect();


// if (strlen($_SESSION['alogin']) == 0) {
//     header('location:index.php');
// } else {
if (isset($_POST['issue'])) {
    $studentid = strtoupper($_POST['studentid']);
    $bookid = $_POST['bookid'];

    // Instantiate the controller
    $controller = new IssueBookController();
    $message = $controller->issueBook($studentid, $bookid, $dbh);
    $_SESSION['msg'] = $message;
    header('location:manage-issued-books.php');
}
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Issue Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }



        h4 {
            text-align: center;
            color: #007bff;
            margin-top: 20px;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        span {
            display: block;
            margin-top: 5px;
            font-size: 14px;
            color: #555;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            color: #ff0000;
            font-weight: bold;
        }
    </style>

</head>

<body>
    <header>
        <?php include('../includes/header.php'); ?>
    </header>


    <p><?php $_SESSION['msg'] ?></p>
    <form method="post">

        <h4>Issue a New Book</h4>
        <div>
            <label>Student ID</label>
            <input type="text" id="studentid" name="studentid" required oninput="getStudentDetails()">
            <span id="student-details"></span>
        </div>

        <div>
            <label>Book ISBN or Title</label>
            <input type="text" id="bookid" name="bookid" required oninput="getBookDetails()">
            <span id="book-details"></span>
        </div>

        <button type="submit" name="issue">Issue Book</button>
    </form>

    <!-- <?php include('../includes/footer.php'); ?> -->

    <script>
        function getStudentDetails() {
            var studentid = document.getElementById('studentid').value;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../get_student.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('student-details').innerHTML = xhr.responseText;
                }
            };
            xhr.send("studentid=" + studentid);
        }

        function getBookDetails() {
            var bookid = document.getElementById('bookid').value;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../get_book.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('book-details').innerHTML = xhr.responseText;
                }
            };
            xhr.send("bookid=" + bookid);

        }
    </script>

</body>

</html>