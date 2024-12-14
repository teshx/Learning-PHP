<?php
require_once __DIR__ . '/../../../middlewares/authMiddleware.php';
checkRole('Admin');

echo "<h1>Welcome, Admin!</h1>";
echo "<p>You can manage the system here.</p>";
?>
<a href="/logout.php">Logout</a>