<?php
include "include/db_credentials.php";
include "include/urldata.php";
session_start();
    if(isset($_SESSION['username'])&&isset($_POST['item-quantity'])&& isset($_POST['pid']))
    {
        /*echo ('post is '.$_POST['username']);
        echo('<br> pid is '.$_POST['pid']);*/
        $connection = mysqli_connect($host, $db_user, $db_pw, $database);
        if(mysqli_connect_errno()){
            echo ("<p>Cannot connect to DB</p>");
        }
        $updatedQuantity = $_POST['item-quantity'];
        $productPrice=1;
        $currentTotalNumber = -1;
        $username = $_SESSION['username'];
        $pid = $_POST['pid'];
        
        $queryUpdateQuantity = "UPDATE Cart SET total_number=?, total_price=? where username=? and pid=?";
        $queryCurrent = "SELECT total_number from Cart where username =? and pid=?";
        $queryGetPidPrice = "SELECT price from Product where pid=?";

        //get Product Price First
        if($stmtGetPidPrice = mysqli_prepare($connection,$queryGetPidPrice) ){
            mysqli_stmt_bind_param($stmtGetPidPrice,"i",$pid);
            mysqli_stmt_execute($stmtGetPidPrice);
            mysqli_stmt_bind_result($stmtGetPidPrice,$rowPidPrice);
            if(mysqli_stmt_fetch($stmtGetPidPrice)){ //get price
                $productPrice = $rowPidPrice;
                /*echo('price for this pid is: '.$productPrice."<br>");
                echo('<p>pid is: '.$pid.' and username is '.$username."</p>");*/
            }
            mysqli_stmt_close($stmtGetPidPrice);
        }
        //get total quantity from current cart
        /*if($stmtGetTotalNumber = mysqli_prepare($connection,$queryCurrent) ){
            echo('STMT GET TOTAL FINE<br>');
            mysqli_stmt_bind_param($stmtGetTotalNumber,"si",$username,$pid);
            mysqli_stmt_execute($stmtGetTotalNumber);
            mysqli_stmt_bind_result($stmtGetTotalNumber,$rowTotalNum);
            if(mysqli_stmt_fetch($stmtGetTotalNumber)){ //get price
                $currentTotalNumber = $rowTotalNum;
                echo('Current total number is: '.$currentTotalNumber);
            }
            mysqli_stmt_close($stmtGetTotalNumber);
        }*/
        $newTotalNumber=$updatedQuantity;
        $newTotalPrice = $productPrice * $newTotalNumber;
        
        if($stmtUpdateQuantity = mysqli_prepare($connection,$queryUpdateQuantity)){
            echo('<p>'.$username." and ".$pid.'</p>');
            mysqli_stmt_bind_param($stmtUpdateQuantity,"iisi",$newTotalNumber,$newTotalPrice,$username,$pid);
            mysqli_stmt_execute($stmtUpdateQuantity);
            
            echo ('row updated: '.mysqli_stmt_affected_rows($stmtUpdateQuantity));
            mysqli_stmt_close($stmtUpdateQuantity);
        }
        mysqli_close($connection);
    }


?>