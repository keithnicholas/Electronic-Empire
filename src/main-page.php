<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>MyAmazon Store 3.0</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/item-style.css">
    <link rel="stylesheet" href="style/main-style.css">
    <link rel="stylesheet" href="style/footer.css">
</head>

<body>
  <?php include "include/header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
        //TODO: Fix Main Page
  ?>

    <main>
        <article id="item-bar">
            <div id="welcome">
                <h1>welcome to our store</h1>
            </div>
            <?php
              $con = mysqli_connect($host, $db_user, $db_pw, $database);
              if (mysqli_connect_errno()) { //if cannot connect
                exit("<p>cannot connect to DB: " . mysqli_connect_error . '</p>');
              }

              $sql_cat = "SELECT category FROM Product GROUP BY category";
              $sql_prod = "SELECT pid, pname, p_img_path FROM Product WHERE category = ?";
              $stmt_prod = NULL;
              $stmt_cat = mysqli_query($con, $sql_cat);
              while($row = mysqli_fetch_row($stmt_cat)) {//get category
                $stmt_prod = mysqli_prepare($con, $sql_prod);
                mysqli_stmt_bind_param($stmt_prod, "s", $row[0]);
                mysqli_stmt_execute($stmt_prod);
                mysqli_stmt_bind_result($stmt_prod, $pid, $pname, $path);
                //category of the product list
                echo ("<div class = \"home-list\"><h3 class=\"category-mainpage\">".$row[0]."</h3><div class =\"img-list\">");
                while(mysqli_stmt_fetch($stmt_prod)) {
                  echo ("<a href= \"item-page.php?pid=".$pid."\"><img src=\"".$path."\"alt=\"".$pname."\"/></a>");
                }//end while
                echo ("</div></div>");
              }//end while
              mysqli_stmt_close($stmt_prod);
             ?>
        </article>
    </main>
  <?php include 'include/footer.php' ?>
</body>

</html>
