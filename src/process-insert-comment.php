<?php
include "include/db_credentials.php";
include 'include/urldata.php';
//header('Content-Type:	application/json');


session_start();
if($_SESSION['active'] == 0) exit();
if (isset($_SESSION['username']) && !empty($_POST['ur-comment-textarea'])) {//send comment to Database
  echo ($_SESSION['username'] );
  echo ($_POST['ur-comment-textarea'] );
  $con = mysqli_connect($host, $db_user, $db_pw, $database);
  if (mysqli_connect_errno()) { //if cannot connect
    exit("<p>cannot connect to DB: " . mysqli_connect_error . '</p>');
  }
  //TODO: SEARCH FOR EXISTING USER IN THE COMMENT SECTION

  $sql_check_user = "SELECT COUNT(*) FROM Comment WHERE username = ? AND pid = ?";
  $stmt_check_user = mysqli_prepare($con, $sql_check_user);
  if (!$stmt_check_user) exit("fail to insert");
  else {
    $username = $_SESSION['username'];
    $pid = $_SESSION['pid'];
    echo($pid."<br>");
    mysqli_stmt_bind_param($stmt_check_user, "si", $username, $pid);
    mysqli_stmt_execute($stmt_check_user);
    mysqli_stmt_bind_result($stmt_check_user, $count);
    mysqli_stmt_fetch($stmt_check_user);
    echo("<br>".$count);
    mysqli_stmt_free_result($stmt_check_user);
    mysqli_stmt_close($stmt_check_user);
    if($count == 0) {
      $sql_product = "INSERT INTO Comment (username, pid, comment_date, comment_info) VALUES(?,?,CURRENT_DATE,?)";
      $stmt = mysqli_prepare($con, $sql_product);
      if (!$stmt) exit("fail to insert");
      else {
        // $username = $_SESSION['username'];
        // $pid = $_SESSION['pid'];
        $comment_info = $_POST['ur-comment-textarea'];
        mysqli_stmt_bind_param($stmt, "sis", $username, $pid, $comment_info);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);//close  statment
        //header("Location: " . $_SERVER['HTTP_REFERER']);
        //mysqli_close($connection);
      }
    }
    else {
      echo("User can only comment once for each product.<br>");
    }
  }


}else { //redirect user to Login page
  header("Location: " . $_SERVER['HTTP_REFERER']);
}


  ?>
