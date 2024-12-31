<?php
// Start the session (optional)
// session_start();

// Get the requested URL path
$requestUri = $_SERVER['REQUEST_URI'];
//die($requestUri);
// Define basic routes
if ($requestUri === '/New-online-liberary-management-system/' || $requestUri === '/index.php') {
    header("Location: ./Home.php");
} elseif ($requestUri === '/New-online-liberary-management-system/login') {
    header("Location: ./views/login.php"); // Show About page
} elseif ($requestUri === '/New-online-liberary-management-system/logout') {
    header("Location: ./views/logout.php"); // Show About page
} elseif ($requestUri === '/New-online-liberary-management-system/admin') {
    header("Location: ./views/dashbords/admin/views/index.php");
} elseif ($requestUri === '/New-online-liberary-management-system/liberaryan') {
    header("Location: ./views/dashbords/liberaryan/views/index.php"); // Show About page
} elseif ($requestUri === '/New-online-liberary-management-system/student') {
    header("Location: ./views/dashbords/student/views/index.php"); // Show About page
} else {
    // If no route is matched, show a 404 error
    echo "page not found";
}

