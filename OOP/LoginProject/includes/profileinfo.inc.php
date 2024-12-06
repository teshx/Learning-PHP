<?php
session_start();
if (isset($_POST["submit"])) {

    //graping the data 

    $id = $_SESSION["userid"];
    $uid = $_SESSION["useriud"];
    $about = $_POST["about"];
    $title = $_POST["introtitle"];
    $text = $_POST["introtext"];



    //instanitiate sign up controler
    include "../classes/DB/dbh.classes.php";
    include "../classes/profile/profileinfo.classes.php";
    include "../classes/profile/profileinfo.contr.classes.php";


    $profileInfo = new profileinfocontrl($id, $uid);
    //Runing error handelers and user signup
    $profileInfo->uppdateprofileInfo($about, $title, $text);
    //going to back to frontpaage
    header("location:../profile.php");
}
