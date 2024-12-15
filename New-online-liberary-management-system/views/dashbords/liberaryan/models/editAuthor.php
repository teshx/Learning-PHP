<?php
require_once '../../../../config/db.php';

class Author
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAuthorById($id)
    {
        $sql = "SELECT * FROM author WHERE id = :id";
        $query = $this->conn->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function updateAuthor($id, $name)
    {
        $sql = "UPDATE author SET name = :name WHERE id = :id";
        $query = $this->conn->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }
}
?>
