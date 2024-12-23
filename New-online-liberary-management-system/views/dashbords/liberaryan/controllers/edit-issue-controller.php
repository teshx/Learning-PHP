<?php
require_once '../models/edit-issue.php';

class IssuedBookController
{
    private $issuedBook;

    public function __construct($db)
    {
        $this->issuedBook = new IssuedBook($db);
    }

    // Fetch issued book by ID
    public function getIssuedBookById($id)
    {
        return $this->issuedBook->getIssuedBookById($id);
    }

    // Update issued book details
    public function updateIssuedBook($data)
    {
        $this->issuedBook->id = $data['id'];
        $this->issuedBook->book_id = $data['book_id'];
        $this->issuedBook->user_id = $data['user_id'];
        $this->issuedBook->issue_date = $data['issue_date'];
        $this->issuedBook->return_date = $data['return_date'];
        $this->issuedBook->status = $data['status'];
        $this->issuedBook->fine = $data['fine'];
        $this->issuedBook->isbn = $data['isbn'];
        $this->issuedBook->username = $data['username'];

        return $this->issuedBook->updateIssuedBook();
    }
}
