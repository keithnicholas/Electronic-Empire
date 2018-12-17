<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>MyAmazon Store 3.0</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/item-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script src="js/item-ajax.js"></script>
</head>

<body>
  <?php include "include/header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";

        $con = mysqli_connect($host, $db_user, $db_pw, $database);
        if(mysqli_connect_errno()){ //if cannot connect
            exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
        }
        $pid = NULL;

        if(isset($_GET['pid']))//receive pid from search bar/itemlist click/main-page click
          $pid = $_GET['pid'];

          $_SESSION['pid'] = $pid;

          $sql_product = "SELECT pid, pname, description, price, p_img_path FROM Product WHERE pid = ?";
          $stmt = mysqli_prepare($con, $sql_product);
          if(!$stmt) exit("fail to select");
          else {
            mysqli_stmt_bind_param($stmt, 's', $pid);
            mysqli_stmt_execute($stmt);

            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt)==0) {
              echo("<h2 align = center>NO ITEM FOUND/ ITEM IS NOT AVAILABLE</h2>");
              exit();
            }
            mysqli_stmt_bind_result($stmt, $pid, $pname, $desc, $price, $path);
            //product info
            mysqli_stmt_fetch($stmt);
            echo("<main><article id=item-bar><div id=main-content-itempage>
            <h2 id=item-page-itemname>".$pname.
            "</h2><figure><img src=\"".$path."\" alt=product></figure>");
            echo("<div id=container-description-price><p id=description-itempage>"
            .$desc."</p><p id=price-itempage>Price: $".$price."</p></div>");
            if(isset($_SESSION['username'])){
                echo("<button class=btn-item-page id=btn-item-page-addcart name=btn-item-page-addcart>Add to Cart</button>");
            }

            echo("</div>");
            mysqli_stmt_free_result($stmt);
            mysqli_stmt_close($stmt);
            echo ("<input type=hidden name=\"secretpid\" id= \"secretpid\" value=".$pid.">");
            if(isset($_SESSION['username'])){
                echo("<input type=hidden name=\"secretusername\" id= \"secretusername\" value=".$username.">");
            }

            //comment session
            echo("<div id=comments-itempage><p id=\"comment\">Comments</p>");
            echo("</div>");
            // mysqli_stmt_free_result($stmt);
            // mysqli_stmt_close($stmt);
            // action=process-comment.php
            if(isset($_SESSION['username']) && isset($_SESSION['active']) && $_SESSION['active']==1) {//user is logged in and comment enabled
              echo("<div id=\"ur-comment\"><p id=\"write-ur-comment\">Write your comment</p>");
              echo("<form id=\"ur-comment-form\" method=POST action=\"process-insert-comment.php\">
              <input type=textarea name=\"ur-comment-textarea\" id=\"ur-comment-textarea\" row=6 cols=70>
              <input class=btn-item-page type=submit name=submit value=submit id=sub>
              </form></div>");
              //TODO: change the style of button in css-all for btn?
            }
            else if (isset($_SESSION['username']) && isset($_SESSION['active']) && $_SESSION['active']==0){//comment disabled
              echo("<div id=ur-comment><p id=write-ur-comment>Write your comment</p>");
              echo("<form id=ur-comment-form>
              <input type=textarea name=ur-comment-textarea row=6 cols=70
              value='Banned from Admin' disabled>
              <input class=btn-item-page type=submit name=submit value=submit disabled></form></div>");
            }
            else{//comment disabled
              echo("<div id=ur-comment><p id=write-ur-comment>Write your comment</p>");
              echo("<form id=ur-comment-form>
              <input type=textarea name=ur-comment-textarea row=6 cols=70
              value='You have to log in to comment this product.' disabled>
              <input class=btn-item-page type=submit name=submit value=submit disabled></form></div>");
            }
            echo("</article></main>");//close main
          }
          mysqli_close($con);
  ?>
  <?php include 'include/footer.php' ?>
</body>

</html>
