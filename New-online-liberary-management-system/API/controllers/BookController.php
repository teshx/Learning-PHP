<?php
include_once '../models/Book.php';
include_once '../../config/db.php';

class BookController
{
    private $bookModel;

    public function __construct()
    {
        // Initialize the database connection
        $database = new Database();
        $db = $database->connect();

        // Initialize the Book model with the database connection
        $this->bookModel = new Book($db);
    }

    public function getBookDetails()
    {
        // Get the books from the model
        $books = $this->bookModel->getBooks();

        // Check if books were found and return appropriate response
        if ($books) {
            echo json_encode($books);
        } else {
            echo json_encode(['message' => 'No books found']);
        }
    }
}
