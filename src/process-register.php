<?php
$host = "localhost";
$database = "";
$user = "root";
$passwordDb = "";
include 'urldata.php';
session_start();

if(isset($_SESSION['username'])){ //if user already logged on, go to home page
    $urlRedict = "home.php";
    header("Location: ".URL.$urlRedict);
}
else{ //verify user from Database
    
    $connection = mysqli_connect($host, $user, $passwordDb, $database);
    if(mysqli_connect_errno()){ //if cannot connect
        exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){ //for POST
        if(isset($_POST['firstName'])&&isset($_POST['lastName'])&&isset($_POST['username']) 
        && isset($_POST['email'])&& isset($_POST['address']) &&isset($_POST['city'])&&isset($_POST['state'])&&isset($_POST['password'])
        &&isset($_POST['cardnum'])&&isset($_POST['cardpass'])){
            $usernameEntered = $_POST['username'];
            $passwordEntered = md5($_POST['password']);
            $firstnameEntered = $_POST['firstName'];
            $lastnameEntered = $_POST['lastName'];
            $emailEntered = $_POST['email'];
            $addressEntered=$_POST['address'];
            $cityEntered=$_POST['city'];
            $stateEntered = $_POST['state'];
            $cardnumEntered=$_POST['cardnum'];
            $cardpassEntered = $_POST['cardpass'];
        }
        else{
            mysqli_close($connection);
            die('<p>Some fields were not entered</p>');
            $urlRedict = "login.php";
            header("Location: ".URL.$urlRedict);
        }
    
    }else{
        mysqli_close($connection);
        die('<p>Error found in GET</p>');
        /*$urlRedict = "login.php";
        header("Location: ".URL.$urlRedict);*/
    }
    $queryCheckUser= "SELECT username from users where username='".$usernameEntered."'";
    $queryCheckPw = "SELECT password from users where username='".$usernameEntered."'";

    $isCorrect = false;
    $resultUname = mysqli_query($connection,$queryCheckUser);
    $resultPw = mysqli_query($connection,$queryCheckPw);
    
    //if a username/pw is found
    if(mysqli_num_rows($resultUname) == 1) 
    {
        $row = mysqli_fetch_assoc($resultPw);
        if($passwordEntered == $row['password'] ){
            $isCorrect = true;
        }
        
    }
    
    if(!$isCorrect){ //if info entered is not valid
        mysqli_close($connection);
        exit("<h3>Username or password is invalid</h3>");
    }
    else{
        //echo ("<h3>User has a valid account</h3>");
    }
    mysqli_free_result($resultPw);
    mysqli_free_result($resultUname);
    mysqli_close($connection);
    $_SESSION["username"] = $usernameEntered;
    $urlRedict = "home.php";
    header("Location: ".URL.$urlRedict);
}



?>