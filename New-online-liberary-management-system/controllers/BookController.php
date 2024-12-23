<?php
require_once __DIR__ . '/../models/Book.php';

class BookController
{
    private $pdo;
    private $bookModel;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->bookModel = new Book($this->pdo);
    }

    // Get details of the book based on the ID
    public function displayBook($bookId)
    {
        return $this->bookModel->getBookDetails($bookId);
    }
}
