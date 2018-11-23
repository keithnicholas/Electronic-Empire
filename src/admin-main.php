<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>MyAmazon Store 3.0</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/additem.css">
    <link rel="stylesheet" href="style/admin-main.css">
</head>

<body>
  <?php include "include/admin-header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
  ?>

    <article id="item-bar">
        <h2>Admin Page</h2>
        <form method=POST id="add-item-form">
            <p class="entry-additem-form">
                <label>User Search:</label>
                <input type="search" size="30" placeholder="Who are you looking for?" />
                <input type="button" value="Search" />
            </p>
        </form>

        <form method="POST" id="result-form">
            <h3>Search Result:</h3>
            <label>Uid:<label id="user-id">13055793</label></label>
            <label>Email:<label id="user-email">aa@ubc.com</label></label>
            <label>ACTION:
                <input type="radio" name="user-control" value="enable" checked/>enable the user
                <input type="radio" name="user-control" value="disable"/>disable the user
            </label>
            <input type="button" name="done" value="confirm">
        </form>

        <form action="POST" id="comment-form">
            <h3>User Comments:</h3>
            <h4>(Check to Remove User Comments)</h4>
            <label><div class="comment-template">
                <input type="checkbox" name="remove">
                <span class="user-comment">Pellentesque habitant morbi tristique senectus et netus et malesuada
                    fames ac turpis egestas.
                    Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                    sit amet quam
                    egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                </span>
            </div></label>
            <label><div class="comment-template">
                <input type="checkbox" name="remove">
                <span class="user-comment">Pellentesque habitant morbi tristique senectus et netus et malesuada
                    fames ac turpis egestas.
                    Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                    sit amet quam
                    egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                </span>
            </div></label>
            <label><div class="comment-template">
                <input type="checkbox" name="remove">
                <span class="user-comment">Pellentesque habitant morbi tristique senectus et netus et malesuada
                    fames ac turpis egestas.
                    Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                    sit amet quam
                    egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                </span>
            </div></label>
            <label><div class="comment-template">
                <input type="checkbox" name="remove">
                <span class="user-comment">Pellentesque habitant morbi tristique senectus et netus et malesuada
                    fames ac turpis egestas.
                    Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                    sit amet quam
                    egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                </span>
            </div></label>
        <input type="button" name="done" value="confirm">
        </form>
    </article>
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
