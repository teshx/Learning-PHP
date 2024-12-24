<?php
class ManageRegistration
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Fetch a user by ID
    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ); // Return user object
    }

    // Update a user's details
    public function updateUser($id, $username, $email, $fullname, $status, $role)
    {
        // First, check if the email already exists in the database (excluding the current user)
        $sql = "SELECT id FROM users WHERE email = :email AND id != :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':email', $email);
        $query->bindParam(':id', $id);
        $query->execute();

        // If the email exists and it is not for the current user
        if ($query->rowCount() > 0) {
            $_SESSION['email'] = "email already exist !!";
            return false; // Return false if email already exists
        }

        // If email is unique, proceed with the update
        $sql = "UPDATE users SET username = :username, email = :email, fullname = :fullname, status=:status, role = :role WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':username', $username);
        $query->bindParam(':email', $email);
        $query->bindParam(':fullname', $fullname);
        $query->bindParam(':status', $status);
        $query->bindParam(':role', $role);
        $query->bindParam(':id', $id);

        return $query->execute(); // Return true if updated successfully
    }
}
