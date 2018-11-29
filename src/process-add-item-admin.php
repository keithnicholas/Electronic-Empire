<?php

include "include/db_credentials.php";
include 'include/urldata.php';
session_start();

if(isset($_SESSION['error'])){
    $_SESSION['error'] = null;
}
$uploadok = true;
if($_SERVER['REQUEST_METHOD'] =='POST') {
  if(isset($_POST['item-name'])&&isset($_POST['producer-name'])&&isset($_POST['price-additem-name'])
  &&isset($_POST['description-additem'])&&isset($_FILES['product-image'])) {
    $name = $_POST['item-name'];
    $producer = $_POST['producer-name'];
    $price = $_POST['price-additem-name'];
    $description = $_POST['description-additem'];

    if(!ctype_digit($price)) {//validate price enter
      exit("invalid price enter.");
    }

    $con = mysqli_connect($host, $db_user, $db_pw, $database);
    if (mysqli_connect_errno()) { //if cannot connect
      exit("<p>cannot connect to DB: " . mysqli_connect_error . '</p>');
    }
    //attempt to upload image to target folder
    $target_dir = "images/";
    $target_file = $target_dir.basename($_FILES['product-image']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $image_size = getimagesize($_FILES['product-image']['tmp_name']);
    $arr_type  = array('jpg','png','gif','jpeg');
    if(!$image_size || !in_array($imageFileType, $arr_type)
    || $_FILES['product-image']['size'] >1024000) {//1MB
      echo("File is too large");
      $_SESSION['error']['file_to_large'] = "File is too large." ;
      $urlRedict = "add-item-admin.php";
      header("Location: ".URL.$urlRedict);
      $uploadok=false;
    }
    if(!$uploadok) {
      exit("sorry, your file was not uploaded<br>");
    }
    else {
      $file_upload_name = $_FILES['product-image']['tmp_name'];
      $result = move_uploaded_file($file_upload_name, $target_file);
    }
    //insert product
    $sql = "INSERT INTO Product(pname, description, price, category,p_img_path)
    VALUES(?,?,?,?,?)";
    $stmt =mysqli_prepare($con, $sql);
    if(!$stmt) exit("fail to insert");
    else {
      mysqli_stmt_bind_param($stmt, "ssiss", $name, $description,$price, $producer, $target_file);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_free_result($stmt);
      mysqli_stmt_close($stmt);//close  statment
      mysqli_close($con);
      //TODO: add a snackbar to make notification fancy
      header("Location: " . $_SERVER['HTTP_REFERER']);
    }//end else
  }//end if isset
}//end if POST
else {//having GET method
  exit("BAD METHOD");
}
 ?>
