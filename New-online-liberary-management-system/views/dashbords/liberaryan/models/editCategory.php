<?php
class Category
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function getCategoryById($id)
    {
        $sql = "SELECT * FROM category WHERE id = :id";
        $query = $this->dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function updateCategory($id, $name, $status)
    {
        $sql = "UPDATE category SET name = :name, status = :status WHERE id = :id";
        $query = $this->dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_INT);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }
}
