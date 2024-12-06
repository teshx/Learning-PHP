<?php
class profileinfocontrl extends profileinfo
{
    private $userId;
    private $userUid;

    public function __construct($userId, $userUid)
    {
        $this->userId = $userId;
        $this->userUid = $userUid;
    }


    public function defultprofileInfo()
    {
        $profileAbout = "Tell about yourself ! Your interset ,hoobies ,or favorite tv show !";
        $profileTitle = "Hi I am " . $this->userUid;
        $profileText = "Welcome to my profile !";
        $this->setprofileinfo($profileAbout, $profileTitle, $profileText, $this->userId);
    }

    public function uppdateprofileInfo($about, $introTitle, $introText)
    {
        if ($this->emptyInput($about, $introTitle, $introText) == true) {
            header("location:./profileSetting.php?error=emptyinput");
            exit();
        }
        $this->setNewprofileinfo($about, $introTitle, $introText, $this->userId);
    }

    private function emptyInput($about, $introTitle, $introText)
    {
        $result;
        if (empty($about) || empty($introTitle) || empty($introText)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
