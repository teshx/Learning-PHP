<?php


session_start();  // This must be at the very top of your file

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private $user;

    public function __construct($pdo)
    {
        $this->user = new User($pdo);
    }

    public function login($username, $password)
    {
        $user = $this->user->findUserByUsernameAndPassword($username, $password);
        if ($user) {
           
            $_SESSION['user_id'] = $user['id'];  // Store user ID
             // Store username
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            header("Location: ../views/dashboard.php");
            exit;
        } else {
            $_SESSION['error']="invalid creadential";
            header("Location: ../views/login.php");
        }
    }
}
