<?php
class ManageRegistration
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Fetch all users
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Delete a user
    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':id', $id);
        return $query->execute();
    }
}
