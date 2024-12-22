<?php
require_once '../../../config/db.php';

// Initialize the database connection
$db = new Database();
$dbh = $db->connect();

if (isset($_POST['bookid'])) {
    $bookid = trim($_POST['bookid']); // Trim and sanitize input

    try {
        // Prepare the query
        $stmt = $dbh->prepare("SELECT * FROM book WHERE ISBNnumber = :bookid OR name LIKE :bookid");

        // Bind parameters
        $stmt->bindParam(':bookid', $bookid, PDO::PARAM_STR);
        $bookname = '%' . $bookid . '%'; // Add wildcards for partial match
        $stmt->bindParam(':bookname', $bookname, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Fetch the result
        $book = $stmt->fetch(PDO::FETCH_ASSOC);



        if ($book) {
            echo "Book Title: " . $book['name'] . "<br>";
            echo "number of Copy: " . $book['numCopy'] . "<br>";
            echo "ISBN: " . $book['ISBNnumber'] . "<br>";
        } else {
            echo "Book not found";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
