<?php
  //CHECKS if user is logged in before accesing further
  if(!isset($_SESSION['username'])){
    $urlRedict = $_SERVER['HTTP_REFERER'];
    header("Location: ".URL.$urlRedict);
}
//TODO: Allow user to change userview info
//TODO: Implements change password and change image
//$host = "localhost";
$database = "project";
$user = $db_user;
$passwordDb = $db_pw;
$connection = mysqli_connect($host, $user, $passwordDb, $database);
if(mysqli_connect_errno()){ //if cannot connect
    exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
}
else{
    $usernameEntered = $_SESSION['username'];

    //put users info in a variable
    $queryUserInfo = "SELECT * from Customer where username='".$usernameEntered."'";
    $resultUserAll = mysqli_query($connection,$queryUserInfo);
    $row = mysqli_fetch_assoc($resultUserAll);
        
    /*$firstNameInfo = $row['firstName'];
    $lastNameInfo= $row['lastName'];
    $emailInfo = $row['email'];*/
    $usernameInfo = $usernameEntered;
    $addressInfo = $row['address'].', '.$row['city'].', '.$row['state'].', '.$row["zip"];
    $emailInfo = $row['email'];
    

    //close connection
    mysqli_close($connection);

}
?>

