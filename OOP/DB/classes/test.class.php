<?php

class test extends dbh
{

    public function getUsers()
    {
        $sql = "SELECT * from users";
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            echo $row['users_firstname'] . '<br>';
        }
    }
    public function getUsersStmt($filename, $lastname)
    {
        $sql = "SELECT * from users WHERE users_firstname=? AND users_lastname= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$filename, $lastname]);
        $names = $stmt->fetchAll();

        foreach ($names as $name) {
            echo $name['users_dateofbirth'] . '<br>';
        }
    }
}
