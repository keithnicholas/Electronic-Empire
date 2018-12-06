<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>MyAmazon Store 3.0</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/user-style.css">
    <script src="js/userview.js"></script>
</head>

<body>
  <?php include "include/header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
        include 'include/urldata.php';
        include "functions-user-view.php";

        if(!isset($_SESSION['username'])) {
          header("Location: login-screen.php");
        }
        else {
          $usernmae = $_SESSION['username'];
        }

  ?>
      <main>
        <article id="item-bar">

            <?php
              echo("<h2 align=center>Welcome Back ".$_SESSION['username']."</h2>");

              echo("<h3>User Profile</h3>");
              $con = mysqli_connect($host, $db_user, $db_pw, $database);
              if(mysqli_connect_errno()){ //if cannot connect
                exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
              }

              update_profile($con, $username);
              //display user comment
              $sql_date = "SELECT comment_date FROM Comment WHERE username = ?
               GROUP BY comment_date ORDER BY comment_date DESC";
              $stmt_date = mysqli_prepare($con, $sql_date);
              mysqli_stmt_bind_param($stmt_date, "s", $username);
              mysqli_stmt_execute($stmt_date);
              mysqli_stmt_bind_result($stmt_date, $date);
              mysqli_stmt_store_result($stmt_date);
              $row = mysqli_stmt_num_rows($stmt_date);

              if($row > 0) {
                echo("<h3>User Activity</h3>");
                while(mysqli_stmt_fetch($stmt_date)) {
                  $sql = "SELECT pname, comment_info
                  FROM  Comment NATURAL JOIN Product
                  WHERE username = ? AND comment_date = ?

                  ORDER BY comment_date DESC";
                  if($stmt = mysqli_prepare($con, $sql)) {
                    mysqli_stmt_bind_param($stmt, "ss", $username, $date);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $pname, $info);

                    echo ("<button class = \"collapsible\">".$date."</button><div class = \"hiddenRow\">");
                    while(mysqli_stmt_fetch($stmt)){
                      echo ("Product: ".$pname."<br>Comment: ".$info."<hr><br>");
                    }
                    echo ("</div>");
                  mysqli_stmt_close($stmt);
                  }//end if
                }//end while
              }//end if
              mysqli_stmt_close($stmt_date);

              ?>

        </article>
    </main>
  <?php include 'include/footer.php' ?>
</body>

</html>
