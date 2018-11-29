<?php

include "include/db_credentials.php";
include "include/urldata.php";
session_start();
if(isset($_SESSION['username'])&& isset($_POST['pid']))
{
        /*echo ('post is '.$_POST['username']);
        echo('<br> pid is '.$_POST['pid']);*/
    $connection = mysqli_connect($host, $db_user, $db_pw, $database);
    if(mysqli_connect_errno()){
        exit ("<p>Cannot connect to DB</p>");
    }
    $username = $_SESSION['username'];
    $pid = $_POST['pid'];
    $queryDelete = "DELETE FROM Cart where username=? and pid=?";
    if($stmtDelete = mysqli_prepare($connection, $queryDelete)){
        mysqli_stmt_bind_param($stmtDelete, "si", $username,$pid);
        mysqli_stmt_execute($stmtDelete);
        echo('<p>row deleted '.mysqli_stmt_affected_rows($stmtDelete).'<p>');
    }
    mysqli_close($connection);
    header("Location: ".$_SERVER['HTTP_REFERER']);
}
else{
    exit('error 404 remove');
}


?>