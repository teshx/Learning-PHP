<?php
require_once '../models/Author.php';

class AuthorController
{
    private $author;

    public function __construct($db)
    {
        $this->author = new Author($db);
    }

    public function getAllAuthors()
    {
        return $this->author->getAllAuthors();
    }

    public function deleteAuthor($id)
    {
        return $this->author->deleteAuthor($id);
    }

    public function createAuthor($name)
    {
        return $this->author->createAuthor($name);
    }

    public function updateAuthor($id, $name)
    {
        return $this->author->updateAuthor($id, $name);
    }
}
