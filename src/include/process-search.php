<?php
    include "db_credentials.php";


    //$connection = mysqli_connect($host, $user, $passwordDb, $database);
    if(mysqli_connect_errno()){ //if cannot connect
        exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
    }
    if(isset($_GET['search_query']) && !empty($_GET['search_query'])){
        $_SESSION['searchquery'] = $_GET['search_query'];


    }else{
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }
    
    
    
    
    
?>


?>