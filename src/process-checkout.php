<?php

include "include/db_credentials.php";
include "include/urldata.php";
session_start();
//TODO: DELETE in cart after array pushed
if(isset($_SESSION['username']) == false ){
    exit('<p>Error no username bug found</p>');
}
//ELSE
$connection = mysqli_connect($host, $db_user, $db_pw, $database);
if(mysqli_connect_errno()){
    echo('cant connect db in cart');
}
$usernameCheckout = $_SESSION['username'];
$arrayCheckout = array();
//Transfer the items in cart to an Array to be transferred to Orders
$queryCheckout = "SELECT pid,total_number,total_price from Cart where username='".$usernameCheckout."'";
if($rst1 = mysqli_query($connection,$queryCheckout)){
    while($row = mysqli_fetch_assoc($rst1)){
        array_push($arrayCheckout,$row);
    }
    
}
else{
    exit('<p>Error 404 check 1</p>');
}


$queryInsertOrder = "Insert INTO Orders (order_date,username,pid,total_number) VALUES (CURRENT_DATE,?,?,?)";
/*foreach($arrayCheckout as $key => $value){
    echo 'hey<br>';
    echo $value['pid'].' '.$value['total_number'];
    echo '<br>';
}*/
//Transfer from Cart to ORder and remove items from cart
if($stmt1 = mysqli_prepare($connection,$queryInsertOrder)){
    
    foreach($arrayCheckout as $key => $value){
        
        mysqli_stmt_bind_param($stmt1,'sii',$usernameCheckout,$value['pid'],$value['total_number']);
        mysqli_stmt_execute($stmt1);
        
        //echo('<br>row inserted to Orders: '.mysqli_stmt_affected_rows($stmt1));
        $queryDelete = "DELETE from Cart where username='".$usernameCheckout."' and pid=".(int)$value['pid'];
        //$queryDelete='select * from customer';
        //echo('<br>'.$queryDelete.'<br>');
        if(mysqli_query($connection,$queryDelete)){
            //echo('running<br>');
            //echo ('row deleted from Cart: '.mysqli_affected_rows($connection));
        }

        
    }
    header("Location: ".URL.'main-page.php');
    mysqli_stmt_close($stmt1);
    
}
/*if($stmtDelete = mysqli_prepare($connection,$queryDelete)){

    mysqli_stmt_bind_param($stmtDelete,'s',$usernameCheckout);
    mysqli_stmt_execute($stmtDelete);
    echo('row deleted from cart: '.mysqli_stmt_affected_rows($stmtDelete));
}*/
else{
    echo 'fail';
}
mysqli_close($connection);


function prettyPrint($arrayCheckout){
$a = json_encode($arrayCheckout);
echo ($a);
}

?>