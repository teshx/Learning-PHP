<?php
class IssuedBook
{
    private $conn;
    private $table = 'issued_books';

    // Properties
    public $id;
    public $book_id;
    public $user_id;
    public $issue_date;
    public $return_date;
    public $status;
    public $fine;
    public $isbn;
    public $username;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get all issued books
    public function getAllIssuedBooks()
    {
        $query = "SELECT id, book_id, user_id, issue_date, return_date, status, fine, isbn, username FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Delete issued book by ID
    public function deleteIssuedBook($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
