<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>MyAmazon Store 3.0-Item-List</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/item-list-style.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script type="text/javascript" src="js/itemlist-ajax.js"></script>
</head>
<body>

  <?php
        //TODO: Fix itemlist so that if user click category list it will just search item in that category, else search all item with SQL LIKE
        include "include/header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
        // session_start();

        $con = mysqli_connect($host, $db_user, $db_pw, $database);
        if(mysqli_connect_errno()){ //if cannot connect
            exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
        }
        $category =$key = NULL;

        if(isset($_GET['category'])){//receive category from category list
            $category = $_GET['category'];
            //image path, pname, description, price
          $sql = "SELECT pid, pname, description, price, p_img_path FROM Product WHERE category = ?";
          $stmt = mysqli_prepare($con, $sql);
          if(!$stmt) exit("fail to select");
          else {
            mysqli_stmt_bind_param($stmt, 's', $category);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $pid, $pname, $desc, $price, $p_img_path);

            echo("<main><div id=\"mainContent\"><h2 id=\"item-type\">".$category."</h2>");
            while(mysqli_stmt_fetch($stmt)) {
              echo("<div class = \"entry\"><figure>
              <a href=item-page.php?pid=".$pid."><img src=\"".$p_img_path."\"alt=product></a>
              </figure>");
              echo("<div class = \"item-info\"><h3>".$pname.
              "</h3><p>".$desc."</p><p>$".$price."</p></div>");//product info
              echo("<form action=include/process-addcart.php method=POST class=form-addcart-itemlist>");
              echo("<input name=addcartpid type=hidden class=hidden-pid-checkout value=".$pid.">");
              has_username();
            }
          }
          mysqli_stmt_free_result($stmt);
          mysqli_stmt_close($stmt);
        }//end isset(category)
        else if(!empty(($_GET['search_query']))) {

          $key = $_GET['search_query'];
          $sql = "SELECT * FROM Product
          WHERE category LIKE '%".$key."%' OR description LIKE '%".$key."%' OR pname LIKE '%".$key."%'";

          if($stmt = mysqli_query($con, $sql)) {
            echo("<main><div id=\"mainContent\">");
            while($row = mysqli_fetch_row($stmt)) {
              echo("<div class = \"entry\"><figure>
              <a href=item-page.php?pid=".$row[0]."><img src=\"".$row[6]."\"alt=product></a>
              </figure>");
              echo("<div class = \"item-info\"><h3>".$row[1].
              "</h3><p>".$row[2]."</p><p>$".$row[3]."</p></div>");//product info
              echo("<form action=include/process-addcart.php method=POST class=form-addcart-itemlist>");
              echo("<input name=addcartpid type=hidden class=hidden-pid-checkout value=".$row[0].">");
              has_username();
            }
          }
        }//end isset(serach_query)
        else {
          $sql = "SELECT * FROM Product";
          echo("<main><div id=\"mainContent\">");
          if($stmt = mysqli_query($con, $sql)) {
            while($row = mysqli_fetch_row($stmt)) {
              echo("<div class = \"entry\"><figure>
              <a href=item-page.php?pid=".$row[0]."><img src=\"".$row[6]."\"alt=product></a>
              </figure>");
              echo("<div class = \"item-info\"><h3>".$row[1].
              "</h3><p>".$row[2]."</p><p>$".$row[3]."</p></div>");//product info
              echo("<form action=include/process-addcart.php method=POST class=form-addcart-itemlist>");
              echo("<input name=addcartpid type=hidden class=hidden-pid-checkout value=".$row[0].">");
              has_username();
            }
          }
        }
        echo("</div></main>");
        mysqli_close($con);

        //enable button if user logged in, otherwise disable the button
        function has_username() {
          if (isset($_SESSION['username'])) {
            echo("<input name=username type=hidden class=hidden-username-checkout value=".$_SESSION['username'].">");
            echo("<button type=\"submit\" class = \"btn1\">Add to Cart</button></form></div>");
          }
          else {//visitor
            echo("<button disabled type=\"submit\" class = \"btn1\">Add to Cart</button></form></div>");
          }
        }
  ?>
  <?php include 'include/footer.php' ?>
</body>
</html>
