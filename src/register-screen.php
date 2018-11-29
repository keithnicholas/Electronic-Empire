<?php include "include/header.php";
        include "include/db_credentials.php";

        //if user already logged on and for some
        //reason goes to this page. redirect back to mainpage
        if(isset($_SESSION['username'])){
            $urlRedict = "main-page.php";
            header("Location: ".URL.$urlRedict);
        }
        session_destroy();
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
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script type="text/javascript" src="js/RegVal.js"></script>

    <!--<script type="text/javascript" src="js/validate.js"></script> -->
</head>

<body>

    <div id="form-container">
        <form  enctype="multipart/form-data"  method="POST" id="mainForm" action="process-register.php">

            <p id="login-text">Register</p>
            <p><label>User name: </label><input type="text" required name="username"><?php
                if(isset($_SESSION['error'])){
                    echo "<span class=\"text-error\">".$_SESSION['error']['useralreadyexists']."</span>";
                    $_SESSION['error']['useralreadyexists'] = null;
                }
            ?>
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
                <label>Post Code: </label><input type="text" required name="postcode">
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
             <P>
                <label>User Image: </label><input type="file" name="userImage" accept="image/png, image/jpeg, image/gif, image/jpg" required><?php
                if(isset($_SESSION['error']['errorImage'])){
                    echo "<span class=\"text-error\">".$_SESSION['error']['errorImage']."</span>";
                    $_SESSION['error']['errorImage'] = null;
                }
            ?>
            </P>
            <button type="submit" id="sign-up" class="button-form">Sign up</button>

        </form>
    </div>
  <?php include 'include/footer.php' ?>
</body>
</html>
