<?php
require_once '../models/editAuthor.php';

class AuthorController
{
    private $authorModel;

    public function __construct($db)
    {
        $this->authorModel = new Author($db);
    }

    public function getAuthor($id)
    {
        return $this->authorModel->getAuthorById($id);
    }

    public function updateAuthor($id, $name)
    {
        return $this->authorModel->updateAuthor($id, $name);
    }
}
