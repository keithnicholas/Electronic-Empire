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
    <script src = "js/jquery-3.1.1.min.js"></script>
    <script src = "js/userview.js"></script>
</head>

<body>
  <?php include "include/header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";

  ?>

    <main>
        <article id="item-bar">
            <div id="welcome">
                <h1 id="main-h1">Electronic Empire</h1>
            </div>
            <!-- hot item tracking -->
            <?php
            $con = mysqli_connect($host, $db_user, $db_pw, $database);
            if (mysqli_connect_errno()) { //if cannot connect
              exit("<p>cannot connect to DB: " . mysqli_connect_error . '</p>');
            }
            $sql = "SELECT pid, pname, p_img_path, SUM(total_number) AS popularity
                    FROM Product NATURAL JOIN OrderedProduct NATURAL JOIN Orders
                    WHERE order_date > CURRENT_DATE -15
                    GROUP BY pid, pname, p_img_path
                    ORDER BY popularity DESC
                    LIMIT 10";
            $stmt_popularity = mysqli_query($con, $sql);
            $row_num = mysqli_num_rows($stmt_popularity);
            if($row_num != 0) {//popularity exists
              echo("<button class = \"collapsible\"><h3 class=\"category-mainpage\">popular items</h3></button><div class = \"hiddenRow\">");
              echo("<div class = \"home-list\"><div class =\"img-list\">");
              while($row = mysqli_fetch_row($stmt_popularity)) {
                echo ("<a href= \"item-page.php?pid=".$row[0]."\"><img src=\"".$row[2]."\"alt=\"".$row[1]."\"/></a>");
              }
              echo ("</div></div></div><hr>");
            }

            mysqli_close($con);

             ?>

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
                echo("<button class = \"collapsible\"><h1 class=\"category-mainpage\">".$row[0]."</h1></button><div class = \"hiddenRow\">");
                echo ("<div class = \"home-list\"><div class =\"img-list\">");
                while(mysqli_stmt_fetch($stmt_prod)) {
                  echo ("<a href= \"item-page.php?pid=".$pid."\"><img src=\"".$path."\"alt=\"".$pname."\"/></a>");
                }//end while
                echo ("</div></div></div><hr>");
              }//end while
              mysqli_stmt_close($stmt_prod);
              mysqli_close($con);
             ?>
        </article>
    </main>
  <?php include 'include/footer.php' ?>
</body>

</html>
