<?php
class Userscontroler extends Users
{


    public function creatUser($filename, $lastname, $dob)
    {
        $this->setUsersStmt($filename, $lastname, date($dob));
    }
}
