<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>MyAmazon Store 3.0</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/form-style.css">
    <link rel="stylesheet" href="style/pay-style.css">
    <script type="text/javascript" src="js/payVal.js"></script>
</head>

<body>
  <?php include "include/header.php";
        include "include/db_credentials.php";
  ?>


    <div id="form-container">
        <form method="POST" id="mainForm" action="login-screen.php">

            <p id="login-text">Transaction In Process...</p>
            <p><label>Full Name: </label><input type="text" required name="nameFieldPay">
            </p>
            <P>
                <label>Shipping Address: </label><input type="text" required name="addressFieldPay">
            </P>
            <P>
                <label>City:</label>
                <input type="text" name="cityFieldPay">
            </P>
            <P>
                <label>State/Province: </label><input type="text" required name="provinceFieldPay">
            </P>
            <P>
                <label>Post Code: </label><input type="text" required required name="post-code" size="6">
            </P>
            <P>
                <label>Card Holder: </label><input type="text" required required name="card-holder">
            </P>
            <P>
                <label>Card Number: </label><input type="text" required name="card-num" size="20">
            </P>
            <P>
                <label>Expiration date:(MM/YY) </label>
                <input type="text" size="2" class="ed" required name="ed-month">/
                <input type="text" size="2" class="ed" required name="ed-yr">

            </p>
            <button type="submit" class="button-form">Submit</button>
            <button type="reset" class="button-form">Reset</button>
        </form>
    </div>
  <?php include 'include/footer.php' ?>
</body>

</html>
