<?php
include_once "headers.php";
?>

<?php
if (isset($_SESSION["useruid"])) {
    header("location:./profile.php");
} ?>
<div class="container">
    <div id="signup-form" style="display: none;">
        <div class=" form-header">
            <h2>Sign Up</h2>
        </div>
        <form action="includes/signup.inc.php" method="post">
            <div class="form-group">
                <label for="signup-username">Username</label>
                <input name="uid" type="text" id="signup-username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="signup-password">Password</label>
                <input name="pwd" type="password" id="signup-password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="signup-repeat-password">Repeat Password</label>
                <input name="pwdrepeat" type="password" id="signup-repeat-password" placeholder="Repeat your password" required>
            </div>
            <div class="form-group">
                <label for="signup-email">Email</label>
                <input name="email" type="email" id="signup-email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <button name="submit" type="submit">Sign Up</button>
            </div>
        </form>
        <div class="switch-link">
            Already have an account? <a href="#" onclick="switchToLogin()">Log In</a>
        </div>
    </div>

    <div id="login-form" ">
        <div class=" form-header">
        <h2>Log In</h2>
    </div>
    <form action="includes/login.inc.php" method="post">
        <div class="form-group">
            <label for="login-username">Username</label>
            <input name="uid" type="text" id="login-username" placeholder="Enter your username" required>
        </div>
        <div class="form-group">
            <label for="login-password">Password</label>
            <input name="pwd" type="password" id="login-password" placeholder="Enter your password" required>
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Log In</button>
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