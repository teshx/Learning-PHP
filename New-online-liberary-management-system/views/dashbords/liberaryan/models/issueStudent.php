<?php
// models/Student.php
class Student
{
    public static function getStudentById($studentid)
    {
        global $dbh; // Ensure $dbh is initialized and available
        try {
            // Adjust query to use the correct column name
            $stmt = $dbh->prepare("SELECT * FROM users WHERE username = :studentid");
            $stmt->bindParam(':studentid', $studentid, PDO::PARAM_STR); // Bind as string since username is likely a string
            $stmt->execute();

            // Return the fetched student record
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log or handle the exception as necessary
            
            echo "Error fetching student: " . $e->getMessage();
            return false;
        }
    }
}
