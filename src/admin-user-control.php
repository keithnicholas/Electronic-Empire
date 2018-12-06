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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script src="js/admin-comment-control.js"></script>
</head>

<body>
  <?php include "include/admin-header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
        session_start();
        if(!isset($_SESSION['username']) ||isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 0){
            echo("<h1 align = center>You do not have access to this page</h1>");
            exit();
        }
        else if(isset($_SESSION['username'])&&isset($_SESSION['isAdmin'])//admin permission check
         &&$_SESSION['isAdmin'] == 1){
            $username = $_SESSION['username'];
        }
        //secure admin pages
        $row_search  = $value =null;
  ?>

    <article id="item-bar">
        <h2>Control Center</h2>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $array_user = array();
        $con = mysqli_connect($host, $db_user, $db_pw, $database);
        if (mysqli_connect_errno()) { //if cannot connect
          exit("<p>cannot connect to DB: " . mysqli_connect_error . '</p>');
        }
        else {
          echo("<form method = \"POST\" id = \"add-item-form\">
          <p class = \"entry-additem-form\">
          <label>User Search:</label>
          <input type = \"search\" size = 30 name = \"user_search\" placeholder = \"Who are you looking for?\"/>
          <input type = \"submit\" value = \"Search\"/></p></form>");

          echo("<form method = \"POST\" id = \"add-item-form\">
          <p class = \"entry-additem-form\">
          <label>Comment Search:</label>
          <input type = \"search\" size = 30 name = \"comment_search\" placeholder = \"Who are you looking for?\"/>
          <input type = \"submit\" value = \"Search\"/></p></form>");
          //Admin---Search User--username/comment info
          if(isset($_POST['user_search'])&& !empty($_POST['user_search'])) {
            $search = $_POST['user_search'];
            $sql = "SELECT username, active from Customer LEFT JOIN Comment USING(username) WHERE username= ? OR email = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $search, $search);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $result,$active);
            while(mysqli_stmt_fetch($stmt)) {
              array_push($array_user, $result);
            }
            $_SESSION['username_search'] = $result;
            mysqli_stmt_close($stmt);
            echo("<form method = \"POST\" action = \"process-user-control.php\">");
            echo "<h3>Search Result:</h3><h4>User Name: ".$result."</h4>";
            if($active == 1) {
              echo("<input type= \"radio\" name = \"user-control\" value = \"enable\" checked/><label>enable</label>
              <input type= \"radio\" name = \"user-control\" value = \"disale\"/><label>disable</label>");
            }
            else {
              echo("<input type= \"radio\" name = \"user-control\" value = \"enable\"/><label>enable</label>
              <input type= \"radio\" name = \"user-control\" value = \"disale\" checked/><label>disable</label>");
            }
            echo("<input class = \"btn-item-page\" type = \"submit\" name = \"done\" value = \"confirm \"/></form>");
          }
          else if(isset($_POST['comment_search'])&& !empty($_POST['comment_search'])) {//potentially, it can result multiple users
            $search = "%".$_POST['comment_search']."%";
            $sql = "SELECT username from Comment WHERE comment_info LIKE ?";
            $stmt = mysqli_prepare($con, $sql);

            mysqli_stmt_bind_param($stmt, "s", $search);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $result);
            while(mysqli_stmt_fetch($stmt)) {
              array_push($array_user, $result);
            }
            mysqli_stmt_close($stmt);

            echo "<h3>Search Result:</h3>";
            foreach($array_user as $key => $value) {//for each user found
              if(count($array_user) == 0 ) {
                echo("<label id = \"user-id\">No User Found</label></form>");
              }
              else {
                echo("<form method = \"POST\" id = \"add-item-form-1\" action = \"\">");
                //Admin--EDIT/DELETE Comments
                  $sql = "SELECT comment_id,comment_date, comment_info, pname
                  FROM Comment NATURAL JOIN Product WHERE username = ? GROUP BY username";
                  $stmt_comment = mysqli_prepare($con, $sql);
                  if(!$stmt_comment) exit("fail to select comment_info");
                  else {
                    mysqli_stmt_bind_param($stmt_comment, "s", $value);
                    mysqli_stmt_execute($stmt_comment);
                    mysqli_stmt_bind_result($stmt_comment, $comment_id, $comment_date, $comment_info, $pname);
                    //print checkbox and comment
                    if(count($array_user) != 0) {
                      echo("<br>");
                      while(mysqli_stmt_fetch($stmt_comment)) {
                        echo("<label><div class = \"comment-template\">
                        <span class=\"comment-entries\">".$value." comments ".$pname." on ".$comment_date."<br>

                        <span class = \"user-comment\">".$comment_info."</span></div>
                        <input type=\"button\" class=\"button-edit-each-comment\" value=Edit>

                        <input type=\"button\" class = \"button-remove-each-comment\"value=Remove>
                        <input type = \"hidden\" name = \"comment_id\" id = \"comment_id\" value = \"".$comment_id."\"/>
                        </label><hr>");
                        // <input type = \"hidden\" name = \"username\" id = \"username\" value = \"".$value."\"/>
                      }//end while
                    }
                  }//else
                  mysqli_stmt_close($stmt_comment);
              }//else
            }//end foreach
          }
        }


        //end else
          mysqli_close($con);
        ?>

    </article>
    <?php include 'include/footer.php' ?>
</body>

</html>
