<?php
include "include/db_credentials.php";
//$host = "localhost";
// $database = "project";
// $user = $db_user;
// $passwordDb = $db_pw;
include 'include/urldata.php';
//TODO: TEST login and register
session_start();
if(isset($_SESSION['errorlogin'])){
    $_SESSION['errorlogin'] = null;
}
if(isset($_SESSION['username'])){ //if user already logged on, go to home page
    $urlRedict = "main-page.php";
    header("Location: ".URL.$urlRedict);
}
else if(isset($_POST['btn-signup']) && !isset($_POST['btn-signin'])){
    $urlRedict = "register-screen.php";
    header("Location: ".URL.$urlRedict);
}
else{ //verify user from Database

    $connection = mysqli_connect($host, $db_user, $db_pw, $database);
    if(mysqli_connect_errno()){ //if cannot connect
        exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){ //for POST
        if(isset($_POST['nameField']) && isset($_POST['passwordField'])){
            $usernameEntered = $_POST['nameField'];
            $passwordEntered = md5($_POST['passwordField']);
            //echo $passwordEntered;
            //$passwordEntered = $_POST['passwordField'];
        }
        else{
            mysqli_close($connection);
            die('<p>Error on isset</p>');
            //$urlRedict = "login.php";
            //header("Location: ".URL.$urlRedict);
        }

    }else{
        //NOTHING SHOULD BE HERE
    }
    $queryCheckUser= "SELECT username,pw from Customer where username=?";
    $isUserValid = false;
    if($stmt1 = mysqli_prepare($connection,$queryCheckUser)){
        mysqli_stmt_bind_param($stmt1,'s',$usernameEntered);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_bind_result($stmt1,$colUsername,$colPassword);
        mysqli_stmt_store_result($stmt1);
        if(mysqli_stmt_num_rows($stmt1) == 1){ //check username by string
            echo ('<p>'.'ok num row'.'</p>');
            if(mysqli_stmt_fetch($stmt1)){
                echo ('<p>'.'ok fetch'.'</p>');
                if($colUsername == $usernameEntered){ //if username is valid and correct
                    if($colPassword == $passwordEntered){
                        echo ('<p>'.$colPassword.'</p>');
                        $isUserValid = true;
                    }

                }
            }

        }
        else{
            echo "<br>Failed t pass stmt1<br>";
        }
        echo (mysqli_stmt_num_rows($stmt1));
        mysqli_stmt_free_result($stmt1);
        mysqli_stmt_close($stmt1);
    }

    if(!$isUserValid){ //if info entered is not valid

        mysqli_close($connection);

        $_SESSION['errorlogin'] = 'Username or password is invalid';
        $urlRedict = "login-screen.php";
        header("Location: ".URL.$urlRedict);
    }
    else{
        echo ("<h3>User: ".$usernameEntered." is logged in. Congrats");
        mysqli_close($connection);
        $_SESSION["username"] = $usernameEntered;
        if($_SESSION["username"] == "Admin")
          $urlRedict = "admin-main.php";
        else
          $urlRedict = $_SERVER[HTTP_REFERER];

        header("Location: ".$urlRedict);

        if(isset($_SESSION['errorlogin'])){
            $_SESSION['errorlogin'] = null;
        }
    }


}



?>
