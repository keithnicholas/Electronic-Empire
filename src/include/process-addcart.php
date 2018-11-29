<?php

//This will be called by AJAX so POST var Will be given by js AJAX
//TODO: ISSUE WITH DATABASE credential in this page
include "db_credentials.php";
if(!isset($_POST['addcartpid']) || !isset($_POST['username'])){ //redirect back if no item is added and somehow the user got here
    //header("Location: ".'s');
    $_POST['addcartpid'] = null;
    exit();
}
//ELSE
//echo ("<p>item cart on</p>");
$connection = mysqli_connect('127.0.0.1', $db_user, $db_pw, $database);
if(mysqli_connect_errno()){ //if cannot connect
    exit('Cant connect to DB');
}

$numberOfCartProduct =0;
$productId = $_POST['addcartpid'];
$usernamePOST = $_POST['username'];
$itemQuantity= 1;
$queryInsert = "INSERT INTO Cart values (?,?,CURRENT_DATE,?,?)";
$sql_find = "SELECT COUNT(*) FROM Cart WHERE username = ? AND pid = ?";
//if exist  return num_row == 1

$sql_price = "SELECT price from Product where pid=?";
if($stmtFind = mysqli_prepare($connection,$sql_find)){

    mysqli_stmt_bind_param($stmtFind, "si",$usernamePOST,$productId);
    mysqli_stmt_execute($stmtFind);
    mysqli_stmt_bind_result($stmtFind,$counter);
    if(mysqli_stmt_fetch($stmtFind)){
        $numberOfCartProduct = $counter; //else null
    }
    mysqli_stmt_close($stmtFind);
}

$productPrice;
if($stmtGetPrice = mysqli_prepare($connection,$sql_price)){
    //echo ('this is running <br>');

    mysqli_stmt_bind_param($stmtGetPrice,'s',$productId);
    mysqli_stmt_execute($stmtGetPrice);
    mysqli_stmt_bind_result($stmtGetPrice,$priceFromDb);
    mysqli_stmt_fetch($stmtGetPrice);
    $productPrice = $priceFromDb;
    mysqli_stmt_close($stmtGetPrice);

}

$sql_add = "UPDATE Cart SET total_number = total_number + 1, total_price = total_price + ? where username=? and pid = ?";
if($numberOfCartProduct >0){ //the product for the particular user is already in the cart. Needs to append
    if($stmtUpdate = mysqli_prepare($connection,$sql_add)){
        mysqli_stmt_bind_param($stmtUpdate,'isi',$productPrice,$usernamePOST,$productId);
        mysqli_stmt_execute($stmtUpdate);
        mysqli_stmt_affected_rows($stmtUpdate);
        // echo("Updating rows: ".mysqli_stmt_affected_rows($stmtUpdate));
        // echo ('<br>');
        mysqli_stmt_close($stmtUpdate);

    }
}
else{ //item hasnt been added by the user
    if($stmt1 = mysqli_prepare($connection,$queryInsert)){ //add new item to cart
        mysqli_stmt_bind_param($stmt1,'siii',$usernamePOST,$productId,$itemQuantity,$productPrice);
        mysqli_stmt_execute($stmt1);
        //echo("Inserting rows: ".mysqli_stmt_affected_rows($stmt1));
        mysqli_stmt_affected_rows($stmt1);
        mysqli_stmt_close($stmt1);
    }
}
mysqli_close($connection);



?>
