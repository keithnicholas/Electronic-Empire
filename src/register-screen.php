<?php include "include/header.php";
        include "include/db_credentials.php";

        //if user already logged on and for some
        //reason goes to this page. redirect back to mainpage
        if(isset($_SESSION['username'])){ 
            $urlRedict = "main-page.php";
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
    <!-- <script type="text/javascript" src="js/RegVal.js"></script> -->
    <script type="text/javascript" src="js/validate.js"></script>
</head>

<body>

    <div id="form-container">
        <form method="POST" id="mainForm" action="process-register.php">

            <p id="login-text">Register</p>
            <p><label>ID: </label><input type="text" required name="username">
            </p>
            <p><label>First Name: </label><input type="text" required name="firstName">
            </p>
            <p><label>Last Name: </label><input type="text" required name="lastName">
            </p>
            <P>
                <label>Email: </label><input type="email" required name="email">
            </P>
            <P>
                <label>Address: </label><input type="text" required name="address">
            </P>
            <P>
                <label>City: </label><input type="text" required name="city">
            </P>
            <P>
                <label>State: </label><input type="text" required name="state">
            </P>
            <P>
                <label>Password: </label><input type="password" required name="password">
            </P>
            <P>
                <label>Card Number: </label><input type="text" required name="cardnum">
            </P>
            <P>
                <label>Card Pass: </label><input type="text" required name="cardpass">
            </P>
            <!-- <P>
                <label>User Image: </label><input type="file" required name="userImage">
            </P> -->
            <button type="submit" id="sign-up" class="button-form">Sign up</button>

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
