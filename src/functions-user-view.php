<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include "include/db_credentials.php";
function update_profile($con, $username) {
  echo "<form method=\"POST\" id=\"mainForm\" enctype=\"multipart/form-data\" action = \"process-userview.php\">";
  echo "<p class=\"entry-user-view\">";
  $sql = "SELECT address, city, state, zip, email,p_img_path FROM Customer where username=?";
  $stmt = mysqli_stmt_init($con);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_bind_param($stmt, "s", $username);
  $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
  mysqli_stmt_store_result($stmt);
  // mysqli_stmt_bind_result($stmt, $address, $city, $state, $zip, $email, $type, $image); //bind in results
  mysqli_stmt_bind_result($stmt, $address, $city, $state, $zip, $email, $p_img_path); //bind in results
  mysqli_stmt_fetch($stmt);
  // echo '<label><img src="data:image/'.$type.';base64,'.base64_encode($image).'"/></label>';
  echo "<label><img src= \"".$p_img_path."\"></label>";
  mysqli_stmt_close($stmt);
  // mysqli_close($con);
  echo "<label><input type = \"file\" name = \"upload-image\" accept = image/png, image/jpeg, image/gif, image/jpg/>
  </label>";
  if(isset($_SESSION['error']['image_extension'])){
    echo "<span class=\"text-error\"> ".$_SESSION['error']['image_extension']." </span>";
    $_SESSION['error']['image_extension'] = null;
  }
  if(isset($_SESSION['error']['file_to_large'])){
    echo "<span class=\"text-error\"> ".$_SESSION['error']['file_to_large']." </span>";
    $_SESSION['error']['file_to_large'] = null;
  }
  if(isset($_SESSION['error']['unable_upload'])){
    echo "<span class=\"text-error\"> ".$_SESSION['error']['unable_upload']." </span>";
    $_SESSION['error']['unable_upload'] = null;
  }
  echo"</p>";
  echo "<p class = \"entry-user-view\"><label>Username: </label><label id = \"user-name\">
  ".$username."</label></p>";

  echo "<p class = entry-user-view><label>Address: </label><label id = \"user-address\">".$address."</label>
  <label><input type = \"textarea\" name = \"address-update\" placeholder = \"update user address.\"/>";
  if(isset($_SESSION['error']['invalid_address'])){
    echo "<span class=\"text-error\"> ".$_SESSION['error']['invalid_address']." </span>";
    $_SESSION['error']['invalid_address'] = null;
  }
  echo "<input type=\"submit\" name=\"user-address\" value=\"update\"/></label></p>";

  echo "<p class = entry-user-view><label>City: </label><label id = \"user-city\">".$city."</label>
  <label><input type = \"textarea\" name = \"city-update\" placeholder = \"update user city.\"/>";
  echo "<input type=\"submit\" name=\"user-city\" value=\"update\"/></label></p>";

  echo "<p class = entry-user-view><label>State: </label><label id = \"user-state\">".$state."</label>
  <label><input type = \"textarea\" name = \"state-update\" placeholder = \"update user state.\"/>";
  echo "<input type=\"submit\" name=\"user-state\" value=\"update\"/></label></p>";

  echo "<p class = entry-user-view><label>Zipcode: </label><label id = \"user-address\">".$zip."</label>
  <label><input type = \"textarea\" name = \"zip-update\" placeholder = \"update user Zip.\"/>";
  echo "<input type=\"submit\" name=\"user-zip\" value=\"update\"/></label></p>";

  echo "<p class = entry-user-view><label>Email: </label><label id = \"user-email\">
  ".$email."</label><label><input type = \"textarea\" name = \"email-update\" placeholder = \"update user email.\"/>";
    if(isset($_SESSION['error']['invalid_email'])){
      echo "<span class=\"text-error\">".$_SESSION['error']['invalid_email']."</span>";
      $_SESSION['error']['invalid_email'] = null;
    }
    echo "<input type=\"submit\" name=\"user-email\" value=\"update\"/></label></p>";
    echo "<div class = \"buttons-form-user\"><button type=\"submit\" name= \"submit-button\">Submit</button></div></form>";
}

 ?>
