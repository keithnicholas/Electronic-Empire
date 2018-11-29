<?php
include "include/db_credentials.php";
include "include/urldata.php";
header('Content-Type: application/json');
if(isset($_GET['pid'])){
    
    $con = mysqli_connect($host, $db_user, $db_pw, $database);
    if(mysqli_connect_errno()){ //if cannot connect
        exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
    }
    $pid = $_GET['pid'];
    $sql_cm = "SELECT username, comment_date, comment_info FROM Comment WHERE pid = ?";
    $stmt = mysqli_prepare($con, $sql_cm);
    if(!$stmt) exit("fail to select<br>");
    else{
        mysqli_stmt_bind_param($stmt, 'i', $pid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $username, $comment_date, $comment_info);
        $jsonArr=array();
        while(mysqli_stmt_fetch($stmt)){

            $arrRow= array('username'=>$username,'comment_date'=>$comment_date,'comment_info'=>$comment_info);
            array_push($jsonArr,$arrRow);

        }
        /*echo (print_r($jsonArr));
        $querytest = "select * from Customer";
        $asd = mysqli_query($con,$querytest);
        while($row= mysqli_fetch_assoc($asd)){
            echo ('<p>');
            echo($row['username']);
            echo ('</p>');
        }*/
        echo (json_encode($jsonArr));
    }
}else{
    echo "pid not found";
}

?>