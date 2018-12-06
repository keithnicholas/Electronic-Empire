<?php

include "include/db_credentials.php";
include 'include/urldata.php';
session_start();

$con = mysqli_connect($host, $db_user, $db_pw, $database);
if (mysqli_connect_errno()) { //if cannot connect
  exit("<p>cannot connect to DB: " . mysqli_connect_error . '</p>');
}

if(isset($_SESSION['error'])){
    $_SESSION['error'] = null;
}
if(isset($_SESSION['username'])&&isset($_SESSION['isAdmin'])//admin permission check
 &&$_SESSION['isAdmin'] == 1){
    $username = $_SESSION['username'];
}

if(isset($_SESSION['username_search']) && isset($_POST['user-control'])) {
  echo("flag");
  if($_POST['user-control'] == "enable") {
    $sql = "UPDATE Customer SET active = 1 WHERE username = ?";
    echo("1");
  }
  else {
    $sql = "UPDATE Customer SET active = 0 WHERE username = ?";
    echo("0");
  }

  $stmt_search = mysqli_prepare($con, $sql);
  mysqli_stmt_bind_param($stmt_search, "s",$_SESSION['username_search']);
  mysqli_stmt_execute($stmt_search);
  mysqli_stmt_close($stmt_search);
}

if(!empty($_POST['comment'])) {
  $comment_list = $_POST['comment'];
  $num_delete_comment = count($comment_list);

  $stmt = null;
  for($i = 0; $i < $num_delete_comment; $i++) {
    echo($comment_list[$i]." ");
    $sql = "DELETE FROM Comment WHERE comment_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    if(!$stmt) exit("failed to delete comment.");
    mysqli_stmt_bind_param($stmt, "i", $comment_list[$i]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
  }
  mysqli_stmt_close($stmt);
}
mysqli_close($con);

$urlRedict = "admin-user-control.php";
header("Location: ".$urlRedict);


 ?>
