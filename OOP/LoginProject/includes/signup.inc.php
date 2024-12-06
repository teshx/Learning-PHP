<?php
if (isset($_POST["submit"])) {

    //graping the data 
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];
    $email = $_POST["email"];

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";


    // echo "<div>
    // <P>$uid</p>
    // <P>$pwd</p>
    // <P>$pwdrepeat</p>
    // <P>$email</p>
    // </div>

    // "


    //instanitiate sign up controler
    include "../classes/DB/dbh.classes.php";
    include "../classes/AUth/signup.classes.php";
    include "../classes/AUth/signup-contr.classes.php";

    $signup = new signupcontr($uid, $pwd, $pwdrepeat, $email);
    //Runing error handelers and user signup
    $signup->signUpuser();

    $userId = $signup->fetchUserId($uid);
    //instanitiat profileinfo 
    include "../classes/profile/profileinfo.classes.php";
    include "../classes/profile/profileinfo.contr.classes.php";
    $profileInfo = new profileinfocontrl($userId, $uid);
    $profileInfo->defultprofileInfo();
    //going to back to frontpaage
    header("location:../index.php?error=none");
}
