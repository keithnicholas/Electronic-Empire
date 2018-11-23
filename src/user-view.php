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
                    <label>User Address:</label>
                    <label id="user-address">3333 University Way, Kelowna, BC V1V 1V7
                    <input type="button"name="user-address" value="edit"/></label>
                </p>
                <p class="entry-user-view">
                    <label>Email:</label>
                    <label id="user-email">aa@a.com<input type="button" name="user-email" value="edit"/></label>
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
    <footer>
        <div id="about-us">
            <p>About Us</p>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                    Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam
                    egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        </div>
        <div class="top-border">
            <div id="contact-us">
                <p>Contact Us</p>
                <p>Email: <a href="#">aa@a.com</a></p>
                <p>Tel: <a href="#">111.222.3333</a></p>
            </div>
        </div>
        <div class="top-border" id="copyright">
            <p>Copyright &copy; 2018 Project</p>
        </div>
    </footer>
</body>

</html>
