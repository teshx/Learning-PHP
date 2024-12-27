<?php
include_once '../../config/db.php';

class Book
{
    private $conn;
    private $table_name = "book";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getBooks()
    {
        // Query to fetch books with related author, category, and location information
        $query = "
            SELECT 
                b.id, 
                b.name AS book_name,
                b.ISBNnumber, 
                b.price, 
                b.image, 
                b.numCopy, 
                b.numBorrowed, 
                b.numReserved,
                l.shelf, 
                l.libraryname, 
                c.name AS category, 
                a.name AS author
            FROM 
                book b
            JOIN 
                author a ON b.authID = a.id
            JOIN 
                category c ON b.catID = c.id
            JOIN 
                location l ON b.locationID = l.id
        ";

        // Prepare the SQL query
        $stmt = $this->conn->prepare($query);

        // Execute the query
        $stmt->execute();

        // Check if there are results
        if ($stmt->rowCount() > 0) {
            // Fetch all the results
            $books = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $books[] = [
                    'id' => $row['id'],
                    'name' => $row['book_name'],
                    'ISBNnumber' => $row['ISBNnumber'],
                    'price' => $row['price'],
                    'image' => $row['image'],
                    'numCopy' => $row['numCopy'],
                    'numBorrowed' => $row['numBorrowed'],
                    'numReserved' => $row['numReserved'],
                    'shelf' => $row['shelf'],
                    'libraryname' => $row['libraryname'],
                    'category' => $row['category'],
                    'author' => $row['author']
                ];
            }
            return $books;
        } else {
            return null; // No books found
        }
    }
}
