<?php
require_once '../models/User.php';

class UserController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new User($db);
    }

    // Fetch user profile for editing
    public function editProfile($userId)
    {
        return $this->userModel->getUserById($userId);
    }

    // Handle profile update
    public function updateProfile($userId, $username, $email, $password = null)
    {
        return $this->userModel->updateUser($userId, $username, $email, $password);
    }
}
