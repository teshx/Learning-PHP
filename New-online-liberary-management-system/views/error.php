<?php
$message = $_GET['message'] ?? 'An error occurred.';
echo "<h1>Error</h1>";
echo "<p>$message</p>";
?>
<a href="./login.php">Back to Login</a>