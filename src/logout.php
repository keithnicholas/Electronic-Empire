<?php
    session_start();
    include "include/urldata.php";
    if(!isset($_SESSION['username'])){ //if users is not loggedin
        $urlRedict = $_SERVER["HTTP_REFERER"];
        header("Location: ".URL.$urlRedict);
    }
    else
    { //if user is logged in
        session_destroy();
        header("Location: ".URL.'main-page.php');
    }

?>