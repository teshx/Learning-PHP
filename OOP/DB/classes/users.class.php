<?php
class Users extends Dbh
{


    protected function getUsers($name)
    {
        $sql = "SELECT * from users WHERE users_firstname= ?  ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name]);
        $result = $stmt->fetchAll();
        return $result;
    }


    protected function setUsersStmt($firstname, $lastname, $dob)
    {
        try {
            $sql = "INSERT INTO users (users_firstname, users_lastname, users_dateofbirth) VALUES (?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$firstname, $lastname, $dob]);
        } catch (PDOException $e) {

            die("Error inserting user: " . $e->getMessage());
        }
    }
}
