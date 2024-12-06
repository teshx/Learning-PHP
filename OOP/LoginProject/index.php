<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup and Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

if (isset($_SESSION["useruid"])) {
    header("location:./profile.php");
}

        header nav {
            display: flex;
            gap: 15px;
        }

        header nav a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        .container {
            width: 400px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 40px auto;
        }

        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-header h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 14px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-group button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .switch-link {
            text-align: center;
            margin-top: 15px;
        }

        .switch-link a {
            color: #007bff;
            text-decoration: none;
        }

        .switch-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">Teshx</div>
        <nav>
            <a href="#">Home</a>
            <a href="#">Service</a>
            <a href="#">Logout</a>
        </nav>
    </header>
    <div class="container">
        <div id="signup-form">
            <div class="form-header">
                <h2>Sign Up</h2>
            </div>
            <form>
                <div class="form-group">
                    <label for="signup-username">Username</label>
                    <input type="text" id="signup-username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="signup-password">Password</label>
                    <input type="password" id="signup-password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <label for="signup-repeat-password">Repeat Password</label>
                    <input type="password" id="signup-repeat-password" placeholder="Repeat your password" required>
                </div>
                <div class="form-group">
                    <label for="signup-email">Email</label>
                    <input type="email" id="signup-email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <button type="submit">Sign Up</button>
                </div>
            </form>
            <div class="switch-link">
                Already have an account? <a href="#" onclick="switchToLogin()">Log In</a>
            </div>
        </div>

        <div id="login-form" style="display: none;">
            <div class="form-header">
                <h2>Log In</h2>
            </div>
            <form>
                <div class="form-group">
                    <label for="login-username">Username</label>
                    <input type="text" id="login-username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <button type="submit">Log In</button>
                </div>
            </form>
            <div class="switch-link">
                Don't have an account? <a href="#" onclick="switchToSignup()">Sign Up</a>
            </div>
        </div>
    </div>

    <script>
        function switchToLogin() {
            document.getElementById('signup-form').style.display = 'none';
            document.getElementById('login-form').style.display = 'block';
        }

        function switchToSignup() {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('signup-form').style.display = 'block';
        }
    </script>
</body>

</html>