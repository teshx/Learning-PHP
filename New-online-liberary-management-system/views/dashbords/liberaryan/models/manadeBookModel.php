<?php
require_once '../../../../config/db.php';

class BookModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function fetchAllBooks()
    {
        // Updated SQL query based on the correct table names
        $sql = "SELECT book.id, book.name, book.image, category.name AS category, author.name AS author, book.ISBNnumber, book.price
                FROM book
                JOIN category ON book.catID = category.id
                JOIN author ON book.authID = author.id";
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteBookById($id)
    {
        $sql = "DELETE FROM book WHERE id = :id";
        $query = $this->conn->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }
}
