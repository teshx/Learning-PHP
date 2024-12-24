<?php
class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function registerUser($username, $password, $role, $fullname, $email)
    {
        // Step 1: Check if the username already exists
        $checkSql = "SELECT COUNT(*) FROM users WHERE username = :username";
        $checkQuery = $this->db->prepare($checkSql);
        $checkQuery->bindParam(':username', $username);
        $checkQuery->execute();

        // Fetch the result
        $userExists = $checkQuery->fetchColumn();

        if ($userExists > 0) {
            // If username already exists, return a message
            $_SESSION['user'] = "Registration failed existing email . ";
            return false;
        }
        // Step 1: Check if the username already exists
        $checkSqll = "SELECT COUNT(*) FROM users WHERE email = :email";
        $checkQueryl = $this->db->prepare($checkSqll);
        $checkQueryl->bindParam(':email', $email);
        $checkQueryl->execute();

        // Fetch the result
        $emailExists = $checkQueryl->fetchColumn();

        if ($emailExists > 0) {
            // If username already exists, return a message
            $_SESSION['email'] = "Registration failed existing email . ";
            return false;
        }
        // Step 2: Insert the new user since the username doesn't exist
        $sql = "INSERT INTO users (username, password, role, fullname, email) 
            VALUES (:username, :password, :role, :fullname, :email)";
        $query = $this->db->prepare($sql);

        // Hash the password
        $hashedPassword = md5($password);

        // Bind parameters
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $hashedPassword);
        $query->bindParam(':role', $role);
        $query->bindParam(':fullname', $fullname);
        $query->bindParam(':email', $email);

        // Execute the query and return the result
        if ($query->execute()) {
            return "User registered successfully!";
        } else {
            return "An error occurred during registration.";
        }
    }
}
