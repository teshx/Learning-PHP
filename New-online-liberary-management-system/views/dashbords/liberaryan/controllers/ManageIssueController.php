<?php
require_once '../models/manage-issue.php';

class IssuedBookController
{
    private $issuedBook;

    public function __construct($db)
    {
        $this->issuedBook = new IssuedBook($db);
    }

    // Get all issued books
    public function getAllIssuedBooks()
    {
        return $this->issuedBook->getAllIssuedBooks();
    }

    // Delete issued book
    public function deleteIssuedBook($id)
    {
        return $this->issuedBook->deleteIssuedBook($id);
    }
}
