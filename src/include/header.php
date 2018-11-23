<?php
include "urldata.php";

session_start();
//$_SESSION['username']= ;
//redirect user to process login if user is not loggedin
$isLoggedIn = false;

if(isset($_SESSION['username'])){
    $isLoggedIn = true;
}
?>
<header class="masthead">
        <div class="entry-header"><!--change p to div -->
            <nav class="navbar">
                <a href="main-page.php">HOME</a>
                <!-- <p> -->
                    <form id="input-form">
                        <input type="search" size="30" placeholder="What are you looking for?">
                        <input type="button" value="Search" />
                    </form>
                <!-- </p> -->
                <div class="top-right-navbar">
                    <a href="checkout.php">CART</a>
                    <?php 
                        if(!$isLoggedIn){ //if user is not logged in
                            echo("<a href=\"login-screen.php\">LOGIN</a>");
                            echo("<a href=\"register-screen.php\">REGISTER</a>");
                        }
                        else{
                            echo "<a href=\"#\">print username</a>";
                            echo("<a href=\"user-view.php\">USER INFO</a>");
                        }
                        session_destroy();
                    ?>
                    <!-- <a href="login-screen.php">LOGIN</a>
                    <a href="register-screen.php">REGISTER</a> -->
                    
                </div>
            </nav>
        </div>
</header>