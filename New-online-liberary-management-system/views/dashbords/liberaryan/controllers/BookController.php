<?php
require_once '../models/Book.php';

class BookController
{
    public function addBookWithLocation($data, $file)
    {
        $book = new Book();
        $result = $book->insertBookWithLocation($data, $file);

        if ($result['success']) {
            echo "<script>alert('Book and Location added successfully!');</script>";
            header('Location: ../views/manage-books.php');
        } else {
            echo "<script>alert('Error: " . $result['error'] . "');</script>";
        }
    }
}
