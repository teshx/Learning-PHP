<?php
class UserController
{
    private $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    public function registerUser($username, $password, $role, $fullname, $email)
    {
        if (empty($username) || empty($password) || empty($role) || empty($fullname) || empty($email)) {
            $_SESSION['error'] = "All fields are required.";
            return false;
        }

        if ($this->userModel->registerUser($username, $password, $role, $fullname, $email)) {
            $_SESSION['success'] = "Author updated successfully.";
            header('location:manage-register.php');
            return true;
        } else {
            if (isset($_SESSION['email'])) {
                $_SESSION['error'] = $_SESSION['email'];
            } else if (isset($_SESSION['user'])) {
                $_SESSION['error'] = $_SESSION['user'];
            } else {
                $_SESSION['error'] = "Registration failed";
            }
            return false;
        }
    }
}
