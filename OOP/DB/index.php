<?php
include 'includes/autolod.php'
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>



    <?php

    $testbobject = new test();
    $testbobject->getUsers();
    $testbobject->getUsersStmt("john", 'Doe');



    $users = new Usersview();
    $users->showUser("john");
    $usersCont = new Userscontroler();
    $usersCont->creatUser("teshx", "habtie", "1994-11-12");
    ?>

</body>

</html>