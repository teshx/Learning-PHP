<?php
include_once "./headers.php";
include "classes/DB/dbh.classes.php";
include "classes/profile/profileinfo.classes.php";
include "classes/profile/profileinfo.contr.classes.php";
include "classes/profile/profileinfo-view.classes.php";

$profileInfo = new profilinfoView();

$profileInfo->featchAbout($_SESSION["userid"]);
echo "<br>";
$profileInfo->featchText($_SESSION["userid"]);
echo "<br>";
$profileInfo->featchTitle($_SESSION["userid"]);
