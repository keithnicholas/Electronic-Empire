<?php include "include/header.php";
        include "include/db_credentials.php";
        //if user already logged on and for some
        //reason goes to this page. redirect back to mainpage
        if(isset($_SESSION['username'])){
            $urlRedict = $_SERVER["HTTP_REFERER"];
            header("Location: ".URL.$urlRedict);
        }
  ?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>MyAmazon Store 3.0</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/form-style.css">
    <script type="text/javascript" src="js/LogVal.js"></script>
</head>

<body>

    <div id="form-container">
        <form method="POST" id="mainForm" action="process-login.php">

            <p id="login-text">Login</p>

            <p>
                <label>User name: </label><input type="text" name="nameField" required><?php
                if(isset($_SESSION['errorlogin'])){
                    echo "<span class=\"text-error\">".$_SESSION['errorlogin']."</span>";
                    $_SESSION['errorlogin'] = null;
                }
                ?>
            </p>
            <P>
                <label>Password: </label><input type="password" name="passwordField" required>
                <a id="forgot-password" href="forgot-pass.php">Forgot password</a>
            </P>
            <!-- <button type="button" class="button-form" id="reset-password">forgot password</button> -->

            <button type="submit" id="sign-in" name="btn-signin" class="button-form">Sign in</button>
            <button type="submit" id="sign-up" name ="btn-singup" class="button-form">Sign up</button>
            <!-- <p id="login-text"><a href="admin-main.php">Admin-Access Placeholder</a></p> -->
        </form>
    </div>
  <?php include 'include/footer.php' ?>
</body>
</html>
