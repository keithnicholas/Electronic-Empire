<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "include/db_credentials.php";

include 'include/urldata.php';
session_start();
//There are 3 error: error image, error user exists
if(isset($_SESSION['error'])){
    $_SESSION['error'] = null;
}
if(isset($_SESSION['username'])){ //if user already logged on, go to home page
    $urlRedict = "main-page.php";
    // header("Location: ".URL.$urlRedict);
}
else{ //verify user from Database

    $connection = mysqli_connect($host, $db_user, $db_pw, $database);
    if(mysqli_connect_errno()){ //if cannot connect
        exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){ //for POST
        if(is_uploaded_file($_FILES['userImage']['tmp_name']) &&isset($_POST['firstName'])&& isset($_POST['lastName'])&&isset($_POST['username'])
        && isset($_POST['email'])&& isset($_POST['address']) &&isset($_POST['city'])&&isset($_POST['state'])&&isset($_POST['password'])
        &&isset($_POST['cardnum'])&&isset($_POST['cardpass']) && isset($_POST['postcode'])){
            $usernameEntered = $_POST['username'];
            $passwordEntered = md5($_POST['password']);
            $firstnameEntered = $_POST['firstName'];
            $lastnameEntered = $_POST['lastName'];
            $emailEntered = $_POST['email'];
            $addressEntered=$_POST['address'];
            $cityEntered=$_POST['city'];
            $stateEntered = $_POST['state'];
            $postcodeEntered = $_POST['postcode'];
            $cardnumEntered=$_POST['cardnum'];
            $cardpassEntered = $_POST['cardpass'];
            // if(!processImage()){
            //     $_SESSION['error']['errorImage'] = "Your uploaded image is either too big, not an image or have an invalid extension";
                // redirect('register-screen.php');
            // }
        }//existing empty fields
        else{
            mysqli_close($connection);
            die('<p>Some fields were not entered</p>');
            // redirect("login-screen.php");
        }

    }else{//method == GET
        mysqli_close($connection);
        die('<p>Error found in GET</p>');
        // redirect("login-screen.php");
    }
    //verify if entries are unique
    $queryCheckEmail = "SELECT username from Customer where email=?";
    $queryCheckUserName = "SELECT username from Customer where username=?";
    $usernameEmailAlready = false;
    //validate username
    if($stmt1 = mysqli_prepare($connection,$queryCheckUserName)){
            mysqli_stmt_bind_param($stmt1,'s',$usernameEntered);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_store_result($stmt1);
            if(mysqli_stmt_num_rows($stmt1) > 0){ //database already have username
                $usernameEmailAlready = true;
            }
            mysqli_stmt_free_result($stmt1);
            mysqli_stmt_close($stmt1);

    }
    //validate email
    if($stmt2 = mysqli_prepare($connection,$queryCheckEmail)){
        mysqli_stmt_bind_param($stmt2,'s',$emailEntered);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_store_result($stmt2);
        if(mysqli_stmt_num_rows($stmt2) > 0){ //database already have email
            $usernameEmailAlready = true;
        }
        mysqli_stmt_free_result($stmt2);
        mysqli_stmt_close($stmt2);

     }
    if($usernameEmailAlready){ //if username/email already exists in DB
        $pageOldRefer = $_SERVER['HTTP_REFERER'];
        //echo '<p>'.$pageOldRefer.'</p>';
        mysqli_close($connection);
        $_SESSION['error']['useralreadyexists'] = "This user already exists" ;
        // redirect($pageOldRefer);
    }else{ //create new user
        //NOTE: upload usre image with path for now.
        $uploadok = 1;
        if(isset($_FILES['userImage'])) {
          $target_dir = "uploads/";
          $target_file = $target_dir.basename($_FILES['userImage']['name']);
          $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
          // $image_size = getimagesize($_FILES['userImage']['tmp_name']);
          $arr_type  = array('jpg','png','gif','jpeg');

          echo($target_dir."<br>");
          //verify image
          // !$image_size ||
          if(!in_array($imageFileType, $arr_type)
          || $_FILES['userImage']['size'] >1024000) {//1MB
            echo("File is too large");
            $_SESSION['error']['file_to_large'] = "File is too large." ;
            // redirect("register-screen.php");
            $uploadok=false;
          }//end if
          if(!$uploadok) {
            $_SESSION['error']['unable_upload'] = "<br>sorry, your file was not uploaded<br>";
            echo($_SESSION['error']['unable_upload']);
          }
          else {
            $file_upload_name = $_FILES['userImage']['tmp_name'];
            echo($file_upload_name);
            if(move_uploaded_file($file_upload_name, $target_file)) {
              //create a Customer first
              $queryCreateUser = 'INSERT INTO Customer (username,first_name,last_name,pw, email, address,city,state,zip,card_number,card_password) Values (?,?,?,?,?,?,?,?,?,?,?)';
              $stmtCreateUser = mysqli_prepare($connection,$queryCreateUser);
              echo("<p>Query is: ".' '.' '.$usernameEntered.' '.$firstnameEntered.' '.$lastnameEntered.' '.$passwordEntered.' '.$emailEntered.' '.$addressEntered.' '.$cityEntered.' '.$stateEntered.' '.$postcodeEntered.' '.$cardnumEntered.' '.$cardpassEntered);
              mysqli_stmt_bind_param($stmtCreateUser,'sssssssssss',$usernameEntered,$firstnameEntered,$lastnameEntered,$passwordEntered,$emailEntered,$addressEntered,$cityEntered,$stateEntered,$postcodeEntered,$cardnumEntered,$cardpassEntered);
              mysqli_stmt_execute($stmtCreateUser);
              echo("<br>rows inserted: ".mysqli_stmt_affected_rows($stmtCreateUser));
              mysqli_stmt_close($stmtCreateUser);
              $printMsg = '<br>an account for the user '.$firstnameEntered.' has been created';
              echo($printMsg);
              //update customer image
              $sql = "UPDATE Customer SET p_img_path = ? WHERE username = ?";
              $stmt_img = mysqli_prepare($connection, $sql);
              if(!$stmt_img) exit("fail to update product");
              mysqli_stmt_bind_param($stmt_img, "ss", $target_file, $usernameEntered);
              mysqli_stmt_execute($stmt_img);
              mysqli_stmt_close($stmt_img);
              echo("<br>passed");
            }
            else {
              $_SESSION['error']['unable_upload'] = "fail to move uploaded file<br>" ;
              echo($_SESSION['error']['unable_upload']);
              // redirect("register-screen.php");
            }
          }
        }//end if
        //upload BLOB
        //
        // $path= "uploads/" . basename($_FILES["userImage"]["name"]);
        // $imageFileType = strtolower(pathinfo($path,PATHINFO_EXTENSION));
        // $imagedata = file_get_contents($path);
        // //store the contents of the files in memory in preparation for upload
        // $sql = "update Customer set userImage = ?, userImageType = ? where username=?";
        //
        // $stmtBLOB = mysqli_stmt_init($connection); //init prepared statement object
        // mysqli_stmt_prepare($stmtBLOB, $sql); // register the query
        // $null = NULL;
        // mysqli_stmt_bind_param($stmtBLOB, "bss", $null, $imageFileType,$usernameEntered);
        //
        // mysqli_stmt_send_long_data($stmtBLOB, 0, $imagedata);
        //
        // $resultBLOB = mysqli_stmt_execute($stmtBLOB) or die(mysqli_stmt_error($stmtBLOB));
        // // run the statement
        // mysqli_stmt_close($stmtBLOB); // and dispose of the statement.

        if(isset($_SESSION['error'])){
            $_SESSION['error'] = null;
        }
        $_SESSION['username'] = $usernameEntered;
        // redirect("main-page.php");
    }

}

function processImage(){
    $maxFileSize = 1000000; //100kb
    $target_dir = "uploads/";

    $target_file = $target_dir . basename($_FILES["userImage"]["name"]);
    $isUploadOk = true;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $validExt=  array("jpg","png","gif","jpeg");
    //$validMime = array("image/jpg",)
    $checkMime = getimagesize($_FILES['userImage']['tmp_name']); //this reutrn false if its not image
    //echo "file image is too big: ".$_FILES['userImage']['size']."<br>";
    $tests = $_FILES['userImage']['size'];
    echo ("mime is ".$checkMime['mime']."<br>file type is ".$imageFileType."<br>image size: ".$tests);

    if($_FILES['userImage']['size'] > $maxFileSize){
        $isUploadOk = false;

    }
    //check if a file uploaded currently in tmp is an iamge
    if($checkMime === true){
        //echo "<P>MIME FAILED ".$checkMime['mime']."</p>";
        //echo "<p>image file mime is ".$checkMime['mime']."</p>";
        $isUploadOk = false;
    }

    if(!in_array($imageFileType,$validExt)){
        //echo "<p>error image file type</p>";
        $isUploadOk = false;
    }

    if(!$isUploadOk){ //if an uploaded image is invalid

        //echo "<p><a href=\"register-screen.php\">Click to go back</a></p>";
        return false;

    }
    else{ //image is valid
        if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $target_file)) {

            return true;
        } else {

            return false;
        }
       //return true;
    }


}
function redirect($page){
    $urlRedict = $page;
    header("Location: ".URL.$urlRedict);
}
?>
