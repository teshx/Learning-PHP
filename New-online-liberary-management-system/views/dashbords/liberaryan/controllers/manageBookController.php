<?php
require_once '../../../../config/db.php';
require_once '../models/manadeBookModel.php';

class BookController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new BookModel($db);
    }

    public function getAllBooks()
    {
        return $this->model->fetchAllBooks();
    }

    public function deleteBook($id)
    {
        return $this->model->deleteBookById($id);
    }
}
