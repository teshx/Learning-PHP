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
</head>

<body>


    <h4>Issue a New Book</h4>
    <p><?php $_SESSION['msg'] ?></p>
    <form method="post">
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