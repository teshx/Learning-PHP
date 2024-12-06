<?php

if (isset($_POST["submit"])) {

    //graping the data 
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];


    //instanitiate sign up controler
    include "../classes/DB/dbh.classes.php";
    include "../classes/AUth/login.classes.php";
    include "../classes/AUth/login-contr.classes.php";

    $logins = new logincontr($uid, $pwd);
    //Runing error handelers and user signup
    $logins->loginuser();
    //going to back to frontpaage
    header("location:../profile.php");
}
