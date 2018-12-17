<?php
  session_start();
  //CHECKS if user is logged in before accesing further
  if(!isset($_SESSION['username'])){
    $urlRedict = $_SERVER['HTTP_REFERER'];
    header("Location: ".URL.$urlRedict);
  }
//TODO: Allow user to change userview info
//TODO: Implements change password and change image
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

    if(isset($_POST['address-update']) && !empty($_POST['address-update'])) {
      $sql_address = "UPDATE Customer SET address = ? WHERE username = ?";
      $stmt_address = mysqli_prepare($con, $sql_address);
      mysqli_stmt_bind_param($stmt_address, "ss", $_POST['address-update'], $username);
      mysqli_execute($stmt_address);
      mysqli_stmt_close($stmt_address);
    }

    if(isset($_POST['email-update']) && !empty($_POST['email-update'])) {
      $sql_email = "UPDATE Customer SET email = ? WHERE username = ?";
      $stmt = mysqli_prepare($con, $sql_email);
      mysqli_stmt_bind_param($stmt, "ss", $_POST['email-update'], $username);
      mysqli_execute($stmt);
      mysqli_stmt_close($stmt);
    }
    if(isset($_FILES['upload-image'])) {
      $uploadOk = 1;
      $target_dir = "uploads/";
      $target_file = $target_dir.basename($_FILES["upload-image"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      //verify  file type
      if($_FILES['upload-image']['size'] == 0) exit("no file added");
        $check = getimagesize($_FILES['upload-image']['tmp_name']);
        $arr_type  = array('jpg','png','gif','jpeg');
        if (!$check || !in_array($imageFileType, $arr_type)){
          echo "<p>File can only be jpg, png, and gif</p>";
          $uploadOk = 0;
        }
        if($_FILES["upload-image"]["size"] > 102400) {//larger than 100kb
          echo "<p>Sorry, your file is too large.</p>";
          $uploadOk = 0;
        }
        if(!$uploadOk)
          echo "<p>Sorry, your file was not uploaded.</p>";
        else {
          if(move_uploaded_file($_FILES['upload-image']['tmp_name'], $target_file))
            echo "<p>The file ". basename($_FILES['upload-image']['tmp_name'])." has been uploaded.</p>";
          else
            echo "<p>Sorry, there was an error uploading yoru file.</p>";
        }//end else
      if($uploadOk) {
        echo("ok");
        $sql = "SELECT userImageType, userImage FROM Customer where username=?";
        $stmt = mysqli_stmt_init($con);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);
        $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
        mysqli_stmt_bind_result($stmt, $type, $image);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $imagedata = file_get_contents($target_file);
        $sql = "UPDATE Customer SET userImage = ?, userImageType = ? WHERE username = ?";
        $stmt = mysqli_stmt_init($con); //init prepared statement object
        mysqli_stmt_prepare($stmt, $sql); // register the query
        $null = NULL;
        mysqli_stmt_bind_param($stmt, "bss", $null, $imageFileType, $_SESSION['username']);
        mysqli_stmt_send_long_data($stmt, 0, $imagedata);//changing $null
        $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
        mysqli_stmt_close($stmt); // and dispose of the statement.
      }
    }
    //close connection
    mysqli_close($con);
    $urlRedict = "user-view.php";
    header("Location: ".$urlRedict);
}

?>
