<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>MyAmazon Store 3.0</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/user-style.css">
</head>

<body>
  <?php include "include/header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
        include 'include/urldata.php';

        if(!isset($_SESSION['username'])) {
          header("Location: login-screen.php");
        }
  ?>
      <main>
        <article id="item-bar">
            <h2>User Profile</h2>
            <?php
              echo "<form method=\"POST\" id=\"mainForm\" enctype=\"multipart/form-data\" action = \"process-userview.php\">";
              echo "<p class=\"entry-user-view\">";
                  $con = mysqli_connect($host, $db_user, $db_pw, $database);
                  if(mysqli_connect_errno()){ //if cannot connect
                      exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
                  }
                  $sql = "SELECT address, city, state, zip, email,
                  userImageType, userImage FROM Customer where username=?";
                  $stmt = mysqli_stmt_init($con);
                  mysqli_stmt_prepare($stmt, $sql);
                  mysqli_stmt_bind_param($stmt, "s", $username);
                  $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
                  mysqli_stmt_bind_result($stmt, $address, $city, $state, $zip, $email, $type, $image); //bind in results
                  mysqli_stmt_fetch($stmt);
                  echo '<label><img src="data:image/'.$type.';base64,'.base64_encode($image).'"/></label>';
                  mysqli_stmt_close($stmt);
                  mysqli_close($con);
                  echo "<label><input type = \"file\" name = \"upload-image\" accept = image/png, image/jpeg, image/gif, image/jpg/>
                  </label></p>";

                  echo "<p class = \"entry-user-view\"><label>Username: </label><label id = \"user-name\">
                  ".$username."</label></p>";

                  echo "<p class = entry-user-view><label>Address: </label><label id = \"user-address\">".$address."</label>
                          <label>
                            <input type = \"textarea\" name = \"address-update\" placeholder = \"update user address.\"/>
                            <input type=\"submit\" name=\"user-address\" value=\"update\"/>
                          </label>
                        </p>";

                  echo "<p class = entry-user-view><label>Email: </label><label id = \"user-email\">
                  ".$email."</label> <label><input type = \"textarea\" name = \"email-update\" placeholder = \"update user email.\"/>
                  <input type=\"submit\" name=\"user-email\" value=\"update\"/></label></p>";

                  echo "<div class = \"buttons-form-user\"><button type=\"submit\" name= \"submit-button\">Submit</button></div></form>";
                  ?>


        </article>
    </main>
  <?php include 'include/footer.php' ?>
</body>

</html>
