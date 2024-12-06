<?php
include "headers.php";
include "classes/DB/dbh.classes.php";
include "classes/profile/profileinfo.classes.php";
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
        .profile-settings {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-settings h3 {
            text-align: center;
            font-size: 24px;
            color: #333;
            /* margin-bottom: 20px; */
        }

        .profile-settings p {
            font-size: 14px;
            color: #666;
            /* margin-bottom: 10px; */
        }

        .profile-settings form {
            display: flex;
            flex-direction: column;

        }

        .profile-settings textarea,
        .profile-settings input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            resize: vertical;
        }

        .profile-settings textarea::placeholder,
        .profile-settings input[type="text"]::placeholder {
            font-style: italic;
            color: #aaa;
        }

        .profile-settings button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .profile-settings button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="profile-settings">
        <h3>PROFILE SETTINGS</h3>
        <p>Change your about section here!</p>
        <form action="includes/profileinfo.inc.php" method="post">
            <textarea name="about" rows="6" cols="30" placeholder="..."><?php echo $profileInfo->featchAbout($_SESSION["userid"]); ?></textarea>
            <br><br>
            <p>Change your profile page intro here!</p>
            <br>
            <input type="text" name="introtitle"
                value="<?php echo $profileInfo->featchTitle($_SESSION["userid"]); ?>"
                placeholder="Profile title...">
            <textarea name="introtext" rows="6" cols="30" placeholder="Profile introduction..."><?php echo $profileInfo->featchText($_SESSION["userid"]); ?></textarea>
            <button type="submit" name="submit">SAVE</button>
        </form>
    </div>

    </div>

</body>

</html>