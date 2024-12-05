<?php
class signup extends dbh
{
    protected function checkUser($uid, $email)
    {
        $stmt = $this->connect()->prepare('SELECT user_id FROM users WHERE users_uid=? OR users_email=?');
        if (!$stmt->execute(array($uid, $email))) {
            $stmt = null;
            header("location:../index.php?error=stmtfiled");
            exit();
        }


        $resultcheck;
        if ($stmt->rowCount() > 0) {
            $resultcheck = false;
        } else {
            $resultcheck = true;
        }

        return $resultcheck;
    }

    protected function setUser($uid, $pwd, $email)
    {
        $stmt = $this->connect()->prepare('INSERT INTO users (users_uid,users_pwd,users_email) VALUE (?,?,?)');

        $hashpassword = password_hash($pwd, PASSWORD_DEFAULT);
        if (!$stmt->execute(array($uid, $hashpassword, $email))) {
            $stmt = null;
            header("location:../index.php?error=stmtfiled");
            exit();
        }


        $stmt = null;
    }
}
