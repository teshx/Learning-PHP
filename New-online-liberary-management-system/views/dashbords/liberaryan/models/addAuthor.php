<?php
class Author
{
    private $db;
    private $table = "author";

    public $id;
    public $name;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Add a new author
    public function createAuthor($name)
    {
        $sql = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
        $query = $this->db->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        return $query->execute();
    }
}
