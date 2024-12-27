<?php
class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Fetch user by ID
    public function getUserById($id)
    {
        $query = "SELECT id, username, email FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user profile
    public function updateUser($id, $username, $email, $password = null)
    {
        if ($password) {
            $query = "UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id";
        } else {
            $query = "UPDATE users SET username = :username, email = :email WHERE id = :id";
        }
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        if ($password) {
            $hashedPassword = md5($password);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        }
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
