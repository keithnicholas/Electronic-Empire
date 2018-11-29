<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>MyAmazon Store 3.0-Item-List</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/checkout-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script type="text/javascript" src="js/checkout-quantity.js"></script>
    
</head>

<body>
  <?php include "include/header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
  ?>

    <main>
        <div id="item-bar">

            <h3 class="shopping-cart">Shopping Cart</h3>
            <?php
              $username = NULL;
              if(isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
              }
              $con = mysqli_connect($host, $db_user, $db_pw, $database);
              if(mysqli_connect_errno()){ //if cannot connect
                  exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
              }
              $sql = "SELECT Product.pid, Product.p_img_path, pname, description, price, total_number
              FROM Product LEFT JOIN Cart USING(pid)
              WHERE username = ?";
              $stmt = mysqli_prepare($con, $sql);
              mysqli_stmt_bind_param($stmt, "s", $username);
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt, $pid, $path, $pname, $description, $price, $total_number);
              //retrieving products from cart for the user
              while(mysqli_stmt_fetch($stmt)) {
                echo("");
                echo("<div class = \"entry\"><figure><a href=\"item-page.php?pid=".$pid."\"><img src=\"".$path."\" alt=\"image-".$pname."\"></a></figure>");
                echo("<div class = \"item-info\"><h4>".$pname."</h4><p>".$description."</p>
                <div class = \"keep-or-remove\"><h4>$".$price *$total_number."</h4>
                <form method=POST action=process-remove-cart.php class=cart-remove><input name=pid type=hidden class=hidden-pid-checkout value=".$pid.">
                <button type=submit value=\"remove\" name = \"remove\">Remove</button></form>
                <p class = \"text-quantity\">Quantity</p>
                <form class=update-quantity-form method=POST action=\"process-quantity-change.php\"><input type = \"number\" class = \"item-quantity\" name = \"item-quantity\" value = \"".$total_number."\" >");
                echo('<input type =submit class=submit-update-button value=Update>');
                echo("<input name=pid type=hidden class=hidden-pid-checkout value=".$pid."></form>");
                echo("</div></div></div>");//closing
              }
              mysqli_stmt_free_result($stmt);
              mysqli_stmt_close($stmt);
              //print subtotal
              $sql = "SELECT sum(total_price) FROM Cart WHERE username = ?";

              if($stmtCartTotal = mysqli_prepare($con, $sql)) {
                mysqli_stmt_bind_param($stmtCartTotal, "s", $username);

                mysqli_stmt_execute($stmtCartTotal);
                mysqli_stmt_bind_result($stmtCartTotal, $sum);
                mysqli_stmt_fetch($stmtCartTotal);
                if($sum != 0)  {
                  echo("<div class = \"entry\" id=\"cancel-entry-div\">
                  <form method = \"POST\" id = \"checkout-form\" name = \"checkout-form\" action = \"process-checkout.php\">");
                  echo("<label>Subtotal:<span id=\"subtotal\">".$sum."</span></label>
                  <input type=\"submit\" id=\"checkout\" class = \"btn\" value=\"Checkout\"/>
                  </form></div>");
                  mysqli_stmt_close($stmtCartTotal);
                }
                else {
                  echo("<h4 class=\"txt-item-notfound\">No item Found</h4>");
                }
              }
             ?>

            <!-- <div class="entry" id="cancel-entry-div">
                <form method="POST" id="checkout-form">
                    <label>Subtotal:<span id="subtotal">$400,000</span></label>
                    <input type="button" id="checkout" class="btn" value="Checkout">
                </form>
            </div> -->
        </div>
    </main>

  <?php include 'include/footer.php' ?>
</body>

</html>
