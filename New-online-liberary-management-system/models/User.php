<?php
require_once __DIR__ . '/../config/db.php';
$db = new Database();
$pdo = $db->connect();

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findUserByUsernameAndPassword($username, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->execute(['username' => $username, 'password' => md5($password)]);
        return $stmt->fetch();
    }
}
