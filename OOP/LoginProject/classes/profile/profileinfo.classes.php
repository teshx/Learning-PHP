<?php
class profileinfo extends dbh
{

    protected function getprofileinfo($userId)
    {

        $stem = $this->connect()->prepare('SELECT * FROM profiles WHERE user_id = ?');

        if (!$stem->execute(array($userId))) {
            $stem = null;
            header("location:../profile.php?error=stmterror");
            exit();
        }
        if ($stem->rowCount() == 0) {
            $stem = null;
            header("location:./profile.php?error=profileisnotfound");
            exit();
        }

        $profileData = $stem->fetchAll(PDO::FETCH_ASSOC);
        return $profileData;
    }
    protected function setNewprofileinfo($profileAbout, $profileTitle, $profileText, $userId)
    {
        $stmt = $this->connect()->prepare('UPDATE profiles SET profiles_about = ?, profiles_introtitle = ?, profiles_introtext = ? WHERE user_id = ?;');


        if (!$stmt->execute(array($profileAbout, $profileTitle, $profileText, $userId))) {
            $stmt = null;
            header("location:./profile.php?error=stmtfiled");
            exit();
        }


        $stmt = null;
    }
    protected function setprofileinfo($profileAbout, $profileTitle, $profileText, $userId)
    {
        $stmt = $this->connect()->prepare('INSERT INTO profiles (profiles_about, profiles_introtitle, profiles_introtext, user_id) VALUES (?, ?, ?, ?);');


        if (!$stmt->execute(array($profileAbout, $profileTitle, $profileText, $userId))) {
            $stmt = null;
            header("location:./profile.php?error=stmtfiled");
            exit();
        }


        $stmt = null;
    }
}
