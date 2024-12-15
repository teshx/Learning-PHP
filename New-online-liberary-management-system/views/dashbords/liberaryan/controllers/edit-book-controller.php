<?php
require_once '../models/edit-book.php';

class BookController
{
    private $book;

    public function __construct($db)
    {
        $this->book = new Book($db);
    }

    public function getBookById($id)
    {
        return $this->book->getBookById($id);
    }

    public function updateBookAndLocation($data)
    {
        return $this->book->updateBookAndLocation($data);
    }
}
