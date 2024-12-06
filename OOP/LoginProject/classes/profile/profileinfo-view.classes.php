<?php
class profilinfoView extends profileinfo
{



    public function featchAbout($userId)
    {
        $profileInfo = $this->getprofileinfo($userId);
        echo $profileInfo[0]["profiles_about"];
    }
    public function featchTitle($userId)
    {
        $profileInfo = $this->getprofileinfo($userId);
        echo $profileInfo[0]["profiles_introtitle"];
    }
    public function featchText($userId)
    {
        $profileInfo = $this->getprofileinfo($userId);
        echo $profileInfo[0]["profiles_introtext"]; 
    }
}
