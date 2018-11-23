<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>MyAmazon Store 3.0</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/item-style.css">
    <link rel="stylesheet" href="style/main-style.css">
    <link rel="stylesheet" href="style/footer.css">
</head>

<body>
  <?php include "include/header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
  ?>

    <main>
        <article id="item-bar">
            <div id="welcome">
                <h1>welcome to our store</h1>
            </div>

            <div class="home-list">
                <h3>Automotive</h3>
                <div class="img-list">
                    <a href="item-page.php"><img src="images/automotive-img-1.jpg" alt="img-automotive" /></a>
                    <a href="itemList.php"><img src="images/automotive-img-2.jpg" alt="img-automotive" /></a>
                    <a href="itemList.php"><img src="images/automotive-img-3.jpeg" alt="img-automotive" /></a>
                </div>
            </div>

            <div class="home-list">
                <h3>Books</h3>
                <div class="img-list">
                    <div class="img-list">
                        <a href="item-page.php"><img src="images/book-1.jpg" alt="img-book" /></a>
                        <a href="itemList.php"><img src="images/book-2.jpg" alt="img-book" /></a>
                        <a href="itemList.php"><img src="images/book-3.jpg" alt="img-book" /></a>
                        <a href="itemList.php"><img src="images/book-4.jpg" alt="img-book" /></a>
                    </div>
                </div>
            </div>

            <div class="home-list">
                <h3>Mountain Equipment</h3>
                <div class="img-list">
                    <a href="item-page.php"><img src="images/me-1.jpg" alt="img-mountain-equip" /></a>
                    <a href="item-page.php"><img src="images/me-2.jpg" alt="img-mountain-equip" /></a>
                    <a href="item-page.php"><img src="images/me-3.jpg" alt="img-mountain-equip" /></a>
                    <a href="item-page.php"><img src="images/me-1.jpg" alt="img-mountain-equip" /></a>
                </div>
            </div>

            <div class="home-list">
                <h3>Electronics</h3>
                <div class="img-list">
                    <a href="item-page.php"><img src="images/laptop-1.png" alt="img-laptop" /></a>
                    <a href="itemList.php"><img src="images/laptop-2.png" alt="img-laptop" /></a>
                    <a href="itemList.php"><img src="images/laptop-4.png" alt="img-laptop" /></a>
                    <a href="itemList.php"><img src="images/handphone-2.png" alt="img-phone" /></a>
                </div>
            </div>
        </article>
    </main>
    <footer>
        <a href="#top" id="back-to-top">Back to Top</a>
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
