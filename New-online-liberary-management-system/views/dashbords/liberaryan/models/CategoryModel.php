<?php
class CategoryModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addCategory($name, $status)
    {
        try {
            $sql = "INSERT INTO category (name, status) VALUES (:name, :status)";
            $query = $this->conn->prepare($sql);
            $query->bindParam(':name', $name, PDO::PARAM_STR);
            $query->bindParam(':status', $status, PDO::PARAM_INT);
            $query->execute();
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            return false;
        }
    }
}
