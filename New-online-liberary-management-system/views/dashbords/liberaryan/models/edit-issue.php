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

    // Get a single issued book by ID
    public function getIssuedBookById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Update issued book record
    public function updateIssuedBook()
    {
        $query = "UPDATE {$this->table} 
                  SET book_id = :book_id, 
                      user_id = :user_id, 
                      issue_date = :issue_date, 
                      return_date = :return_date, 
                      status = :status, 
                      fine = :fine, 
                      isbn = :isbn, 
                      username = :username 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':book_id', $this->book_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':issue_date', $this->issue_date);
        $stmt->bindParam(':return_date', $this->return_date);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':fine', $this->fine);
        $stmt->bindParam(':isbn', $this->isbn);
        $stmt->bindParam(':username', $this->username);

        return $stmt->execute();
    }
}
