<?php
session_start();
//$_SESSION['username']= ;
//redirect user to process login if user is not loggedin
$isLoggedIn = false;

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $isLoggedIn = true;
}
?>
<header class="masthead">
        <div class="entry-header"><!--change p to div -->
            <nav class="navbar">
                <a href="main-page.php">HOME</a>
                <!-- <p> -->
                    <form id="input-form" method="GET" action="itemList.php">
                        <input type="search" size="30" name="search_query" id = "search_query"placeholder="What are you looking for?">
                        <input type="submit" value="Search" class = "submit-search"/>
                    </form>
                <!-- </p> -->
                <div class="top-right-navbar">
                    <?php
                        if(!$isLoggedIn){ //if user is not logged in
                            echo("<a href=\"login-screen.php\">Login</a>");
                            echo("<a href=\"register-screen.php\">Register</a>");
                        }
                        else if($_SESSION['username'] != "Admin"){
                            echo ("<a href=\"checkout.php\">".$username."'s Cart"."</a>");
                            echo("<input type=hidden class=username-in-header value=".$username.">");
                            echo "<a href=\"logout.php\">Log out</a>";
                            echo "<a href=\"user-view.php\">".$username."</a>";

                            //echo("<a href=\"user-view.php\">USER INFO</a>");
                        }
                        else {
                          echo("<a href =\"add-item-admin.php\">ADD ITEM</a>");
                          echo("<a href =\"edit-item-admin.php\">EDIT ITEM</a>");
                          echo "<a href=\"logout.php\">LOG OUT</a>";
                          echo("<a href =\"admin-view.php\">".$username."</a>");
                          echo("<a href =\"admin-main.php\">ADMIN MAIN</a>");
                        }

                    ?>
                    <!-- <a href="login-screen.php">LOGIN</a>
                    <a href="register-screen.php">REGISTER</a> -->

                </div>
            </nav>
        </div>
</header>
<!-- <div class="items">
  <ul class = "breadcrumb">
    <li><a href="main-page.php">Home</a></li>
  </ul>
</div> -->
