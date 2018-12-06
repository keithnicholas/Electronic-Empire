<?php

include "include/db_credentials.php";
include 'include/urldata.php';
session_start();

if(isset($_SESSION['error'])){
    $_SESSION['error'] = null;
}

$uploadok = true;

$pid = $item_name = $category = $price = $description = $image = null;
if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['item-id'])) {//admin entered pid
  $pid = $_POST['item-id'];

  $con = mysqli_connect($host, $db_user, $db_pw, $database);
  if (mysqli_connect_errno()) { //if cannot connect
    exit("<p>cannot connect to DB: " . mysqli_connect_error . '</p>');
  }

  if(isset($_POST['choice']) && $_POST['choice'] == "UPDATE") {//admin performs UPDATE
    if(isset($_POST['item-name']) && !empty($_POST['item-name'])) {
      $item_name = $_POST['item-name'];
      $sql = "UPDATE Product SET pname = ? WHERE pid = ?";
      $stmt_pname = mysqli_prepare($con, $sql);
      if(!$stmt_pname) exit("fail to update product");
      mysqli_stmt_bind_param($stmt_pname, "si", $item_name, $pid);
      mysqli_stmt_execute($stmt_pname);
      mysqli_stmt_close($stmt_pname);
    }
    if(isset($_POST['item-category']) && !empty($_POST['item-category'])) {
      $category = $_POST['item-category'];
      $sql = "UPDATE Product SET category = ? WHERE pid = ?";
      $stmt_cat = mysqli_prepare($con, $sql);
      if(!$stmt_cat) exit("fail to update product");
      mysqli_stmt_bind_param($stmt_cat, "si", $category, $pid);
      mysqli_stmt_execute($stmt_cat);
      mysqli_stmt_close($stmt_cat);
    }
    if(isset($_POST['item-price']) && !empty($_POST['item-price'])) {
      $price = $_POST['item-price'];
      $sql = "UPDATE Product SET price = ? WHERE pid = ?";
      $stmt_price = mysqli_prepare($con, $sql);
      if(!$stmt_price) exit("fail to update product");
      mysqli_stmt_bind_param($stmt_price, "ii", $price, $pid);
      mysqli_stmt_execute($stmt_price);
      mysqli_stmt_close($stmt_price);
    }
    if(isset($_POST['item-description']) && !empty($_POST['item-description'])) {
      $description = $_POST['item-description'];
      $sql = "UPDATE Product SET description = ? WHERE pid = ?";
      $stmt_description = mysqli_prepare($con, $sql);
      if(!$stmt_description) exit("fail to update product");
      mysqli_stmt_bind_param($stmt_description, "si", $description, $pid);
      mysqli_stmt_execute($stmt_description);
      mysqli_stmt_close($stmt_description);
    }
    echo("flag1<br>");

    if(isset($_FILES['item-image'])) {
      echo("flag2<br>");
      $image = $_FILES['item-image'];

      $target_dir = "images/";
      $target_file = $target_dir.basename($_FILES['item-image']['name']);
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      $image_size = getimagesize($_FILES['item-image']['tmp_name']);
      $arr_type  = array('jpg','png','gif','jpeg');

      echo($target_dir."<br>");

      //verify image
      if(!$image_size || !in_array($imageFileType, $arr_type)
      || $_FILES['item-image']['size'] >1024000) {//1MB
        echo("File is too large");
        $_SESSION['error']['file_to_large'] = "File is too large." ;
        $urlRedict = "edit-item-admin.php";
        header("Location: ".URL.$urlRedict);
        $uploadok=false;
      }//end if
      if(!$uploadok) {
        $_SESSION['error']['unable_upload'] = "sorry, your file was not uploaded<br>";
        echo($_SESSION['error']['unable_upload']);
      }
      else {
        $file_upload_name = $_FILES['item-image']['tmp_name'];
        $result = move_uploaded_file($file_upload_name, $target_file);
      }
      $sql = "UPDATE Product SET p_img_path = ? WHERE pid = ?";
      $stmt_img = mysqli_prepare($con, $sql);
      if(!$stmt_img) exit("fail to update product");
      mysqli_stmt_bind_param($stmt_img, "si", $target_file, $pid);
      mysqli_stmt_execute($stmt_img);
      mysqli_stmt_close($stmt_img);
      echo("passed");
    }//end if

  }
  else if($_POST['choice'] == "DELETE") {
    $sql = "DELETE FROM Product WHERE pid = ?";
    $stmt_delete = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt_delete, "i", $pid);
    mysqli_stmt_execute($stmt_delete);
    mysqli_stmt_close($stmt_delete);
  }
  $urlRedict = "edit-item-admin.php";
  header("Location: " .$urlRedict);
}//end if POST
else {//having GET method
  exit("BAD METHOD");
}
 ?>
