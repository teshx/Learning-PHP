<?php
require_once __DIR__ . '/../../../middlewares/authMiddleware.php';
checkRole('Astudent');

echo "<h1>Welcome, Admin!</h1>";
echo "<p>You can manage the system here.</p>";
?>
<a href="/logout.php">Logout</a>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    this is student
</body>

</html>