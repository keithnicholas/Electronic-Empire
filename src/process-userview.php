<?php
  // error_reporting(E_ALL);
  // ini_set('display_errors', 1);
  session_start();
  //CHECKS if user is logged in before accesing further
  if(!isset($_SESSION['username'])){
    $urlRedict = $_SERVER['HTTP_REFERER'];
    header("Location: ".URL.$urlRedict);
  }
include "include/db_credentials.php";
$connection = mysqli_connect($host, $db_user, $db_pw, $database);
if(mysqli_connect_errno()){ //if cannot connect
    exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
}
else if($_SERVER["REQUEST_METHOD"] =="POST"){
    $username = $_SESSION['username'];

    $con = mysqli_connect($host, $db_user, $db_pw, $database);
    if(mysqli_connect_errno()){ //if cannot connect
        exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
    }
    //put users info in a variable
    // $queryUserInfo = "SELECT * from Customer where username='".$usernameEntered."'";
    // $resultUserAll = mysqli_query($connection,$queryUserInfo);
    // $row = mysqli_fetch_assoc($resultUserAll);

    /*$firstNameInfo = $row['firstName'];
    $lastNameInfo= $row['lastName'];
    $emailInfo = $row['email'];*/
    // $usernameInfo = $usernameEntered;
    // $addressInfo = $row['address'].', '.$row['city'].', '.$row['state'].', '.$row["zip"];
    // $emailInfo = $row['email'];
    //update on address
    if(isset($_POST['address-update']) && !empty($_POST['address-update']) && valideAddress($_POST['address-update'])) {
      $sql_address = "UPDATE Customer SET address = ? WHERE username = ?";
      $stmt_address = mysqli_prepare($con, $sql_address);
      mysqli_stmt_bind_param($stmt_address, "ss", $_POST['address-update'], $username);
      mysqli_execute($stmt_address);
      mysqli_stmt_close($stmt_address);
    }
    //update on email
    if(isset($_POST['email-update']) && !empty($_POST['email-update']) && valideEmail($_POST['email-update'])) {
      $sql_email = "UPDATE Customer SET email = ? WHERE username = ?";
      $stmt = mysqli_prepare($con, $sql_email);
      mysqli_stmt_bind_param($stmt, "ss", $_POST['email-update'], $username);
      mysqli_execute($stmt);
      mysqli_stmt_close($stmt);
    }
    if(isset($_POST['city-update']) && !empty($_POST['city-update'])) {
      $sql_email = "UPDATE Customer SET city = ? WHERE username = ?";
      $stmt = mysqli_prepare($con, $sql_email);
      mysqli_stmt_bind_param($stmt, "ss", $_POST['city-update'], $username);
      mysqli_execute($stmt);
      mysqli_stmt_close($stmt);
    }
    if(isset($_POST['state-update']) && !empty($_POST['state-update'])) {
      $sql_email = "UPDATE Customer SET state = ? WHERE username = ?";
      $stmt = mysqli_prepare($con, $sql_email);
      mysqli_stmt_bind_param($stmt, "ss", $_POST['state-update'], $username);
      mysqli_execute($stmt);
      mysqli_stmt_close($stmt);
    }
    if(isset($_POST['zip-update']) && !empty($_POST['zip-update'])) {
      $sql_email = "UPDATE Customer SET zip = ? WHERE username = ?";
      $stmt = mysqli_prepare($con, $sql_email);
      mysqli_stmt_bind_param($stmt, "ss", $_POST['zip-update'], $username);
      mysqli_execute($stmt);
      mysqli_stmt_close($stmt);
    }
    //update on image
    if(is_uploaded_file($_FILES['upload-image']['tmp_name'])) {
      $uploadOk = 1;
      $target_dir = "uploads/";
      $target_file = $target_dir.basename($_FILES["upload-image"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      //verify  file type
      if($_FILES['upload-image']['size'] == 0) exit("no file added");
        $check = getimagesize($_FILES['upload-image']['tmp_name']);
        $arr_type  = array('jpg','png','gif','jpeg');
        if (!$check || !in_array($imageFileType, $arr_type)){
          // echo "<p>File can only be jpg, png, and gif</p>";
          $_SESSION['error']['image_extension'] = "Image can can only be jpg, jpeg, png, and gif";
          $uploadOk = 0;
        }
        if($_FILES["upload-image"]["size"] > 102400) {//larger than 100kb
          // echo "<p>Sorry, your file is too large.</p>";
          $_SESSION['error']['file_to_large'] = "File is too large." ;
          $uploadOk = 0;
        }
        if(!$uploadOk)
          $_SESSION['error']['unable_upload'] = "failed to upload image";
        else {
          if(move_uploaded_file($_FILES['upload-image']['tmp_name'], $target_file))
            echo "<p>The file ". basename($_FILES['upload-image']['tmp_name'])." has been uploaded.</p>";
          else
            echo "<p>Sorry, there was an error uploading yoru file.</p>";
        }//end else
      if($uploadOk) {
        echo("ok");
        //NOTE: WORKS WITH P_IMG_PATH
        $sql = "UPDATE Customer SET p_img_path = ? WHERE username = ?";
        $stmt = mysqli_stmt_init($con);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $target_file, $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        //NOTE: WORKS WITH BLOB
        // $sql = "SELECT userImageType, userImage FROM Customer where username=?";
        // $stmt = mysqli_stmt_init($con);
        // mysqli_stmt_prepare($stmt, $sql);
        // mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);
        // $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
        // mysqli_stmt_bind_result($stmt, $type, $image);
        // mysqli_stmt_fetch($stmt);
        // mysqli_stmt_close($stmt);
        //
        // $imagedata = file_get_contents($target_file);
        // $sql = "UPDATE Customer SET userImage = ?, userImageType = ? WHERE username = ?";
        // $stmt = mysqli_stmt_init($con); //init prepared statement object
        // mysqli_stmt_prepare($stmt, $sql); // register the query
        // $null = NULL;
        // mysqli_stmt_bind_param($stmt, "bss", $null, $imageFileType, $_SESSION['username']);
        // mysqli_stmt_send_long_data($stmt, 0, $imagedata);//changing $null
        // $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
        // mysqli_stmt_close($stmt); // and dispose of the statement.
      }
    }
    //close connection
    mysqli_close($con);
    $urlRedict = "user-view.php";
    header("Location: ".$urlRedict);
}

function valideEmail($email) {
  $con = mysqli_connect($host, $db_user, $db_pw, $database);
  if(mysqli_connect_errno()){ //if cannot connect
      exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
  }
  $sql = "SELECT username FROM Customer WHERE email = ?";
  $stmt = mysqli_prepare($con, $sql);
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_execute($stmt);
  mysqli_stmt_store_result($stmt);
  if(mysqli_stmt_num_rows($stmt) == 1)
    $_SESSION['error']['invalid_email'] = "The email address has been used.";
  else {
    $pos = strpos($email, '@');
    if($pos === false)
      $_SESSION['error']['invalid_email'] = "Invalid Format. ex:abc@xyz.com";
  }
  mysqli_stmt_close($stmt);
  mysqli_close($con);
}

function valideAddress($address) {
  if(strlen($address) > 5) {
    return true;
  }
  else {
    $_SESSION['error']['invalid_address'] = "Invalid Address, address's length must be at least 5 characters.";
    return false;
  }
}
?>
