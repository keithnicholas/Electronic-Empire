<?php
include "include/db_credentials.php";
include "include/urldata.php";


if(isset($_POST['comment_id']) && !isset($_POST['edit'])){ //runs on delete

    $con = mysqli_connect($host, $db_user, $db_pw, $database);
    if(mysqli_connect_errno()){ //if cannot connect
        exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
    }
    $cid = $_POST['comment_id'];
    $sql_del = "DELETE FROM Comment WHERE comment_id =?";
    $stmt = mysqli_prepare($con, $sql_del);
    if(!$stmt) exit("fail to select<br>");
    else{
        mysqli_stmt_bind_param($stmt,'i',$cid);
        mysqli_stmt_execute($stmt);
        //echo ('Deletion affected row: '.mysqli_affected_rows($con));
        mysqli_stmt_close($stmt);
        
    }
    $url = $_SERVER['HTTP_REFERER'];
    header('Location: '.$url);
    mysqli_close($stmt);
    exit();
}
if(isset($_POST["new_msg"])&&isset($_POST['comment_id']) && isset($_POST['edit'])){ //runs on edit
    
    $newMsg = $_POST['new_msg'];
    $con = mysqli_connect($host, $db_user, $db_pw, $database);
    if(mysqli_connect_errno()){ //if cannot connect
        exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
    }
    $cid = $_POST['comment_id'];
    $sql_del = "UPDATE Comment SET comment_info=? WHERE comment_id =?";
    $stmt = mysqli_prepare($con, $sql_del);
    if(!$stmt) exit("fail to select<br>");
    else{
        mysqli_stmt_bind_param($stmt,'si',$newMsg,$cid);
        mysqli_stmt_execute($stmt);
        //echo ('Insertion affected row: '.mysqli_affected_rows($con));
        mysqli_stmt_close($stmt);
        
    }
    
    $url = $_SERVER['HTTP_REFERER'];
    header('Location: '.$url);
    mysqli_close($stmt);
    exit();
}
else{
    //echo "comment_id not found";
    exit('Error 404 in inserting');
}

?>
