<?php
// models/Book.php
class Book
{
    public static function getBookByIdOrIsbn($bookid)
    {
        global $dbh;

        // Prepare SQL query to search by ISBNnumber or book name
        $stmt = $dbh->prepare("SELECT * FROM book WHERE ISBNnumber = :bookid OR name LIKE :bookid");

        // Add wildcards to the book name for partial matching
        $bookidWithWildcards = '%' . $bookid . '%';

        // Bind the parameters
        $stmt->bindParam(':bookid', $bookid);
        $stmt->bindParam(':bookid', $bookidWithWildcards); // Fix: Binding both parameters

        // Execute the query
        $stmt->execute();

        // Fetch and return the result
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
