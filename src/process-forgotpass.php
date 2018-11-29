<?php

include "include/db_credentials.php";
include 'include/urldata.php';


require 'phpmailer/PHPMailerAutoload.php';

if(isset($_POST['forgotpassField'])) {
  $user_email = $_POST['forgotpassField'];

  $con = mysqli_connect($host, $db_user, $db_pw, $database);
  if(mysqli_connect_errno()){ //if cannot connect
      exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
  }
  $sql = "UPDATE Customer SET pw = ? WHERE email = ?";
  $rand_pw = generateRandomString();
  $hashed_pw = md5($rand_pw);
  $stmt = mysqli_prepare($con, $sql);
  mysqli_stmt_bind_param($stmt, "ss", $hashed_pw, $user_email);
  mysqli_stmt_execute($stmt);

  if(mysqli_stmt_affected_rows($stmt)) {//if user found and email updated

    // echo("UPDATE SUCCESSFU<br>");
    // echo("Password: ".$rand_pw);
    $mail = new PHPMailer;
    // $mail->SMTPDebug = 4;   // Enable verbose debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    // $mail->HOST='localhost';
    $mail->Port =465;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure='ssl';

    $mail->Username='puck19970418@gmail.com';
    $mail->Password='Wzl_19970418';
    // $mail->setForm($user_email);
    $mail->setFrom('puck19970418@gmail.com');
    $mail->addAddress($user_email);
    // $mail->addReplyTo('puck19970418@gmail.com');

    $mail->isHTML(true);
    $mail->Subject='PHP Mailer Subject';
    $mail->Body='<p>Dear user, your password has been reset to: <br>'.$rand_pw.'</p>';
    if(!$mail->send()) {
      $_SESSION['error']['InvalidEmail'] = 'User not exist, or invalid email address';
      $urlRedirect = "forgot-pass.php";
      header("Location: ".$urlRedirect);
    }
    else {
      $urlRedirect = "login-screen.php";
      header("Location: ".$urlRedirect);
    }
  }
  else {
    $_SESSION['error']['InvalidEmail'] = 'User not exist, or invalid email address';
    $urlRedirect = "forgot-pass.php";
    header("Location: ".$urlRedirect);
  }
  mysqli_stmt_close($stmt);
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

 ?>
