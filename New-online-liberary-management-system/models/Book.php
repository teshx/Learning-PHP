<?php
class Book
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Fetch book details based on the book ID
    public function getBookDetails($bookId)
    {
        $sql = "
            SELECT 
                book.id AS BookID,
                book.name AS BookName,
                book.ISBNnumber,
                book.price,
                book.image,
                book.locationID,
                book.numCopy,
                book.status AS BookStatus,
                book.numBorrowed,
                book.numReserved,
                category.name AS Category,
                author.name AS Author,
                location.shelf,
                location.libraryname,
                location.copynumber
            FROM 
                book
            JOIN category ON book.catID = category.id
            JOIN author ON book.authID = author.id
            JOIN location ON book.locationID = location.id
            WHERE book.id = :bookId";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
