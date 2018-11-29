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

<body
  <?php include "include/header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
        include 'include/urldata.php';
  ?>
  <?php
    include "process-userview.php";
  ?>
    <main>
        <article id="item-bar">
            <h2>User Profile</h2>
            <form method="POST" id="mainForm">

                <p class="entry-user-view">
                    <label><a href="#">
                        <img src="images/700.jpg" alt="user-image" title="edit"/></a>
                    </label>
                    <label><input type="file" name="upload-pic" accept="image/*"/>
                    </label>
                </p>
                <p class="entry-user-view">
                    <label>Username:</label>
                    <label id="user-address"><?php echo ($usernameInfo); ?></label>
                <p class="entry-user-view">
                    <label>User Address:</label>
                    <label id="user-address"><?php echo($addressInfo); ?>
                    <input type="button"name="user-address" value="edit"/></label>
                </p>
                <p class="entry-user-view">
                    <label>Email:</label>
                    <label id="user-email"><?php echo($emailInfo); ?><input type="button" name="user-email" value="edit"/></label>
                </p>
                <p class="entry-user-view">
                    <label>Password:</label>
                    <label id="user-Password">********<input type="button" name="user-password" value="edit"/></label>
                </p>
                <p></p>
                <div class="buttons-form-user">
                    <button type="submit" name="submit-button">Submit</button>
                </div>
            </form>
        </article>
    </main>
  <?php include 'include/footer.php' ?>
</body>

</html>
