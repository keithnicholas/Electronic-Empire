<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>MyAmazon Store 3.0</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/additem.css">
    <link rel="stylesheet" href="style/admin-main.css">
</head>

<body>
  <?php include "include/admin-header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
        session_start();
        if(isset($_SESSION['username'])&&isset($_SESSION['isAdmin'])//admin permission check
         &&$_SESSION['isAdmin'] == 1){
            $username = $_SESSION['username'];
        }
        $row_search  = $_SESSION['username_search'] =null;
  ?>

    <article id="item-bar">
        <h2>Control Center</h2>
        <?php

        $con = mysqli_connect($host, $db_user, $db_pw, $database);
        if (mysqli_connect_errno()) { //if cannot connect
          exit("<p>cannot connect to DB: " . mysqli_connect_error . '</p>');
        }
        else {
          echo("<form method = \"POST\" id = \"add-item-form\">
          <p class = \"entry-additem-form\">
          <label>User Search:</label>
          <input type = \"search\" size = 30 name = \"search\" placeholder = \"Who are you looking for?\"/>
          <input type = \"submit\" value = \"Search\"/></p></form>");
          //Admin---Search User
          if(isset($_POST['search'])&& !empty($_POST['search'])) {

            $search = $_POST['search'];
            $sql = "SELECT username from Customer LEFT JOIN Comment USING(username) where username= ? OR email = ? OR comment_info = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $search, $search, $search);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_fetch($stmt);
            $row_search = mysqli_stmt_num_rows($stmt);
            $_SESSION['username_search'] = $search;
            mysqli_stmt_close($stmt);
          }

          echo("<form method = \"POST\" id = \"add-item-form-1\" action = \"process-user-control.php\">");
          if($row_search == 0 && !empty($_SESSION['username_search'])) {
            echo("<h3>Search Result:</h3><label>User name: <label id = \"user-id\">No User Found</label></label></form>");
          }
          else if($row_search == 0 && !isset($_SESSION['username_search'])) {
            echo("</form>");
          }
          else {
            echo("<h3>Search Result:</h3><label>User name: <span id = \"user-id\">".$_SESSION['username_search']."</span></label>");
            echo("<p class=\"entry-additem-form\"><input type = \"radio\" name = \"user-control\" value = \"enable\" checked/><label>Enable</label>");
            echo("<input type = \"radio\" name = \"user-control\" value = \"disable\"/><label>Disable</lable></p>");
            //Admin--EDIT/DELETE Comments

            $sql = "SELECT comment_id, comment_date, comment_info, pname FROM Comment C JOIN Product P ON C.pid = P.pid WHERE username = ?";
            $stmt_comment = mysqli_prepare($con, $sql);
            if(!$stmt_comment) exit("fail to select comment_info");
            else {
              mysqli_stmt_bind_param($stmt_comment, "s", $_SESSION['username_search']);
              mysqli_stmt_execute($stmt_comment);
              mysqli_stmt_bind_result($stmt_comment, $comment_id, $comment_date, $comment_info, $pname);
              //print checkbox and comment
              if($row_search != 0) {
                echo("<h3>".$_SESSION['username_search']." 's Comments:</h3><hr>");
                while(mysqli_stmt_fetch($stmt_comment)) {
                  echo("<label><div class = \"comment-template\">
                  <span class=\"comment-entries\">".$comment_date." ON ".$pname."<br>
                  <input type = \"checkbox\" name = \"comment[]\" value = \"".$comment_id."\">
                  <span class = \"user-comment\">".$comment_info."</span></div></label><hr>");
                }//end while

                echo("<input class = \"btn-item-page\" type = \"submit\" name = \"done\" value = \"confirm \"/></form>");
              }
            }//else
            mysqli_stmt_close($stmt_comment);
          }//else
        }//end else
        mysqli_close($con);
        ?>

    </article>
    <?php include 'include/footer.php' ?>
</body>

</html>
