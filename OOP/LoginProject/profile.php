<?php
include_once "./headers.php";
include "classes/DB/dbh.classes.php";
include "classes/profile/profileinfo.classes.php";
include "classes/profile/profileinfo.contr.classes.php";
include "classes/profile/profileinfo-view.classes.php";

$profileInfo = new profilinfoView();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .profile-section {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-family: Arial, sans-serif;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-section h3 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .profile-section p {
            font-size: 16px;
            color: #555;
            margin: 10px 0 5px;
        }

        .profile-section div {
            font-size: 14px;
            color: #444;
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            word-wrap: break-word;
            white-space: pre-wrap;
        }

        .profile-section div.profile-title {
            font-weight: bold;
            text-align: center;
        }

        .go-to-settings {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .go-to-settings:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }

        .go-to-settings:active {
            background-color: #3e8e41;
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <div class="profile-section">
        <h3>Your Profile</h3>
        <p><strong>About:</strong></p>
        <div class="profile-about">
            <?php echo $profileInfo->featchAbout($_SESSION["userid"]); ?>
        </div>
        <p><strong>Introduction Text:</strong></p>
        <div class="profile-introtext">
            <?php echo $profileInfo->featchText($_SESSION["userid"]); ?>
        </div>
        <p><strong>Profile Title:</strong></p>
        <div class="profile-title">
            <?php echo $profileInfo->featchTitle($_SESSION["userid"]); ?>
        </div>
    </div>

    <a href="./profilesetting.php" class="go-to-settings">Go to Settings</a>



</body>

</html>