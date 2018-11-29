<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>MyAmazon Store 3.0-Item-List</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/item-list-style.css">
    <link rel="stylesheet" href="style/footer.css">
</head>
<body>

  <?php
        //TODO: Fix itemlist so that if user click category list it will just search item in that category, else search all item with SQL LIKE
        include "include/header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";

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
              echo("<div class = \"item-info\"><p>".$pname.
              "</p><p>".$desc."</p><p>$".$price."</p></div>");//product info
              echo("<button type=\"button\" class = \"btn\">Add to Cart</button></div>");
            }
            echo("</div></main>");
          }
          mysqli_stmt_free_result($stmt);
          mysqli_stmt_close($stmt);
        }//end isset(category)
        else if(!empty(($_GET['search_query']))) {

          $key = $_GET['search_query'];
          $sql = "SELECT * FROM Product
          WHERE category LIKE '%".$key."%' OR description LIKE '%".$key."%' OR pname LIKE '%".$key."%'";

          if($stmt = mysqli_query($con, $sql)) {
            while($row = mysqli_fetch_row($stmt)) {
              echo("<div class = \"entry\"><figure>
              <a href=item-page.php?pid=".$row[0]."><img src= \"".$row[6]."\" alt=product></a>
              </figure>");
              echo("<div class = \"item-info\"><p>".$row[1].
              "</p><p>".$row[2]."</p><p>$".$row[3]."</p></div>");//product info
              echo("<button type=\"button\" class = \"btn\">Add to Cart</button></div>");
            }
          }
        }//end isset(serach_query)
        else {
          $sql = "SELECT * FROM Product";
          echo("<main><div id=\"mainContent\">");
          if($stmt = mysqli_query($con, $sql)) {
            while($row = mysqli_fetch_row($stmt)) {
              echo("<div class = \"entry\"><figure>
              <a href=item-page.php?pid=".$row[0]."><img src= \"".$row[6]."\" alt=product></a>
              </figure>");
              echo("<div class = \"item-info\"><p>".$row[1].
              "</p><p>".$row[2]."</p><p>$".$row[3]."</p></div>");//product info
              echo("<button type=\"button\" class = \"btn\">Add to Cart</button></div>");
            }
          }
        }
        mysqli_close($con);
  ?>
  <?php include 'include/footer.php' ?>
</body>
</html>
