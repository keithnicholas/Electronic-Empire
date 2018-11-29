<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>MyAmazon Store 3.0</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/form-style.css">
</head>

<body>
  <?php include "include/header.php";
        include "include/db_credentials.php";
        if(!isset($_SESSION))
          session_start();
  ?>
    <div id="form-container">
        <form method="POST" id="mainForm" action = "process-forgotpass.php">

            <!-- <legend><span id="login-text">Login</span></legend> -->
            <p id="login-text">Recover Password</p>
            <p>
                <label>Email: </label><input type="text" required name="forgotpassField">
                <?php
                if(isset($_SESSION['error']['InvalidEmail'])){
                    echo "<span class=\"text-error\">".$_SESSION['error']['InvalidEmail']."</span>";
                    $_SESSION['error']['InvalidEmail'] = null;
                }
                ?>
            </p>


            <button type="submit" id="sign-in" class="button-form">Submit</button>
        </form>
    </div>
  <?php include 'include/footer.php' ?>
</body>

</html>
