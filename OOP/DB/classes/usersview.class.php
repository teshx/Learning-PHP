<?php


class Usersview extends Users
{

    public function showUser($name)
    {
        $results = $this->getUsers($name);

        if (!empty($results)) {
            foreach ($results as $result) {
                echo "Full name: " . $result['users_firstname'] . " " . $result['users_lastname'] . "<br>";
            }
        } else {
            echo "No user found with the name '$name'.";
        }
    }


}
