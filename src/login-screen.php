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
  <?php include "include/header.php";
        include "include/db_credentials.php";
  ?>

    <div id="form-container">
        <form method="POST" id="mainForm">


            <p id="login-text">Login</p>

            <p>
                <label>ID: </label><input type="text" name="nameField" required>
            </p>
            <P>
                <label>Password: </label><input type="password" name="passwordField" required>
                <a id="forgot-password" href="forgot-pass.php">Forgot password</a>
            </P>
            <!-- <button type="button" class="button-form" id="reset-password">forgot password</button> -->

            <button type="button" id="sign-in" class="button-form">Sign in</button>
            <button type="button" id="sign-up" class="button-form">Sign up</button>
            <p id="login-text"><a href="admin-main.php">Admin-Access Placeholder</a></p>
        </form>
    </div>
    <footer>
        <div id="about-us">
            <p>About Us</p>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                    Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam
                    egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        </div>
        <div class="top-border">
            <div id="contact-us">
                <p>Contact Us</p>
                <p>Email: <a href="#">aa@a.com</a></p>
                <p>Tel: <a href="#">111.222.3333</a></p>
            </div>
        </div>
        <div class="top-border" id="copyright">
            <p>Copyright &copy; 2018 Project</p>
        </div>
    </footer>
</body>
</html>
