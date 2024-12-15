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

    // Fetch all authors
    public function getAllAuthors()
    {
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Delete an author by ID
    public function deleteAuthor($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }

    // Add a new author
    public function createAuthor($name)
    {
        $sql = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
        $query = $this->db->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        return $query->execute();
    }

    // Update an author's name
    public function updateAuthor($id, $name)
    {
        $sql = "UPDATE " . $this->table . " SET name = :name WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        return $query->execute();
    }
}
