<?php
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
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header("Location: ../views/dashboard.php");
            exit;
        } else {
            header("Location: ../views/error.php?message=Invalid credentials");
        }
    }
}
