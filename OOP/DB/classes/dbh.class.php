<?php
class Dbh
{
    private $host = 'localhost'; // Database host
    private $user = 'php'; // Database username
    private $pwd = 'php'; // Database password
    private $dbName = 'php'; // Database name

    protected function connect()
    {
        try {
            // Create the DSN (Data Source Name)
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;

            // Create a new PDO instance
            $pdo = new PDO($dsn, $this->user, $this->pwd);

            // Set PDO attributes for error handling and fetch mode
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;
        } catch (PDOException $e) {
            // Handle connection errors gracefully
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
