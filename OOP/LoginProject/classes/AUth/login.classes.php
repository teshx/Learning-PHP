<?php
class login extends dbh
{



    protected function getUser($uid, $pwd)
    {
        $stmt = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_uid=? OR users_email=?;');


        if (!$stmt->execute(array($uid, $pwd))) {
            $stmt = null;
            header("location:../index.php?error=stmtfiled");
            exit();
        }
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location:../index.php?error=usernotfound");
            exit();
        }


        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkpwd = password_verify($pwd, $pwdHashed[0]['users_pwd']);
        $stmt = null;

        if ($checkpwd == false) {
            $stmt = null;
            header("location:../index.php?error=wrongpassword");
            exit();
        } elseif ($checkpwd == true) {
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_uid=? OR users_email=? AND users_pwd=?;');
            if (!$stmt->execute(array($uid, $uid, $pwd))) {
                $stmt = null;
                header("location:../index.php?error=stmtfaild");
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location:../index.php?error=usernotfound");
                exit();
            }
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($user)) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION["userid"] = $user[0]["user_id"];
                $_SESSION["useruid"] = $user[0]["users_uid"];
            } else {
                header("location: ../index.php?error=nouser");
                exit();
            }

        }
        $stmt = null;
    }
}
