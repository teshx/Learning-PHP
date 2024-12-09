<?php
class Database
{
    private $host = 'localhost'; // Database host
    private $user = 'blog'; // Database username
    private $pwd = 'blog'; // Database password
    private $dbName = 'blog'; // Database name

    public function connect()
    {
        try {
           
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;

         
            $pdo = new PDO($dsn, $this->user, $this->pwd);

           
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;
        } catch (PDOException $e) {
            
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
