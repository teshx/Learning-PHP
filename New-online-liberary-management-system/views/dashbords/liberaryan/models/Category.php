<?php
class Category
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM category"; // Fetch all rows from the category table
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ); // Return as objects
    }

    public function deleteCategory($id)
    {
        $sql = "DELETE FROM category WHERE id = :id"; // Delete based on id
        $query = $this->db->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT); // Bind id parameter
        return $query->execute(); // Execute the query
    }

    public function addCategory($name, $status)
    {
        $sql = "INSERT INTO category (name, status) VALUES (:name, :status)"; // Insert into name and status
        $query = $this->db->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR); // Bind name parameter
        $query->bindParam(':status', $status, PDO::PARAM_INT); // Bind status parameter
        return $query->execute(); // Execute the query
    }
}
