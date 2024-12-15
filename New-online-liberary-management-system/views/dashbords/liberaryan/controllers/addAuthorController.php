<?php
require_once '../models/Author.php';

class AuthorController
{
    private $author;

    public function __construct($db)
    {
        $this->author = new Author($db);
    }

    public function createAuthor($name)
    {
        return $this->author->createAuthor($name);
    }
}
