<?php
$message = $_GET['message'] ?? 'An error occurred.';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8d7da;
            color: #721c24;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            box-sizing: border-box;
        }

        .error-container {
            text-align: center;
            background-color: #f5c6cb;
            padding: 20px 30px;
            border: 1px solid #f1b0b7;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin: 0 0 10px;
            font-size: 24px;
        }

        p {
            margin: 0 0 20px;
            font-size: 18px;
        }

        a {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            color: #ffffff;
            background-color: #c82333;
            border-radius: 4px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #a71d2a;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <h1>Error</h1>
        <p><?php echo htmlspecialchars($message); ?></p>
        <a href="./login.php">Back to Login</a>
    </div>
</body>

</html>