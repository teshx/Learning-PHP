<?php
// controllers/IssueBookController.php
include('../models/issueBook.php'); // Assuming the model file name is Book.php
include('../models/issueStudent.php'); // Assuming the model file name is Student.php
require_once '../../../../config/db.php';

// Create a new Database object and connect
$database = new Database();
$dbh = $database->connect();

class IssueBookController
{
    public function issueBook($studentid, $bookid, $dbh)
    {
        // Ensure session is started at the beginning of your script
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Only start session if not already started
        }

        try {
            // Validate that the student ID and book ID are valid
            if (is_numeric($studentid) || is_numeric($bookid)) {
                throw new Exception("Invalid student ID or book ID.");
            }

            // Get the student details using the student ID
            $student = Student::getStudentById($studentid);
            if (!$student) {
                $_SESSION['e'] = "Error: Student with ID $studentid not found.";
                throw new Exception("Student not found");
            }

            $uid = $student['id'];
            $username = $student['username'];
            if (!$uid || !$username) {
                throw new Exception("userid not found");
            }

            // Get the book details using the book ID
            $book = Book::getBookByIdOrIsbn($bookid);
            if (!$book) {
                $_SESSION['e'] = "Error: Book with ID $bookid not found.";
                throw new Exception("Book not found");
            }


            $boid = $book['id'];
            $isbn = $book['ISBNnumber'];
            $numCopy = $book['numCopy'];
            $numBrr = $book['numBorrowed'];
            $numRR = $book['numReserved'];


            if (!($numCopy > $numBrr)) {


                if (
                    $numBrr > $numRR
                ) {
                    return "ALL Book is Borrowed you can Reserve";
                } else {
                    return "ALL Book Borrowed and reserved";
                }
            }




            // Issue the book (add to issued_books table)
            $status = 'Issued';
            $issue_date = date('Y-m-d');
            $return_date = $this->calculateReturnDate($student['role'], $issue_date);

            // Prepare SQL query for inserting the issued book into the database
            $sql = "INSERT INTO issued_books (book_id, user_id, issue_date, return_date, status, fine, isbn, username) 
                VALUES (:boid, :uid, :issue_date, :return_date, :status, :fine,:isbn,:username)";

            // Prepare and bind parameters
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':boid', $boid, PDO::PARAM_INT);  // Bind book ID
            $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);  // Bind student ID
            $stmt->bindParam(':issue_date', $issue_date, PDO::PARAM_STR);
            $stmt->bindParam(':return_date', $return_date, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':fine', $fine = 0, PDO::PARAM_INT); // Assuming fine is 0 initially
            $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR); // Assuming fine is 0 initially
            $stmt->bindParam(':username', $username, PDO::PARAM_STR); // Assuming fine is 0 initially

            // Execute the query and check for success
            if ($stmt->execute()) {
                $_SESSION['e'] = "Success: Book with ID $bookid issued to student with ID $studentid.";
                return "Book issued successfully";
            } else {
                $_SESSION['e'] = "Error: Failed to issue the book with ID $bookid.";
                throw new Exception("Error in issuing book");
            }
        } catch (Exception $e) {
            // Catch and return the exception message
            $_SESSION['e'] = $e->getMessage(); // Store the exception message in the session for error feedback
            return "Error: " . $e->getMessage();
        }
    }




    private function calculateReturnDate($role, $issue_date)
    {
        $interval = ($role === 'Member') ? 2 : 5; // 2 days for members, 5 days for others
        return date('Y-m-d', strtotime("$issue_date + $interval days"));
    }
}
