<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>MyAmazon Store 3.0-Item-List</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/item-list-style.css">
    <link rel="stylesheet" href="style/footer.css">
</head>

<body>
  <?php include "include/header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
  ?>

    <main>
        <div id="mainContent">
            <h2 id="item-type">Automotive</h2>
            <div class="entry">
                <figure>
                    <a href="item-page.php"><img src="images/example-mazda3.jpg" alt="item1"></a>
                </figure>
                <div class="item-info">
                    <p>All-new Echo Dot (3rd Gen) - Smart speaker with Alexa - Charcoal</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>
                    <p>$100,000</p>
                </div>
                <button type="button" class="btn">Add to Cart</button>
            </div>

            <div class="entry">
                <figure>
                    <a href="item-page.php"><img src="images/tiny.jpg" alt="item2"></a>
                </figure>
                <div class="item-info">
                    <p>All-new Echo Dot (3rd Gen) - Smart speaker with Alexa - Charcoal</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>
                    <p>$100,000</p>
                </div>
                <button type="button" class="btn">Add to Cart</button>
            </div>

            <div class="entry">
                <figure>
                    <a href="item-page.php"><img src="images/tiny.jpg" alt="item3"></a>
                </figure>
                <div class="item-info">
                    <p>All-new Echo Dot (3rd Gen) - Smart speaker with Alexa - Charcoal</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>
                    <p>$100,000</p>
                </div>
                <button type="button" class="btn">Add to Cart</button>
            </div>

            <div class="entry">
                <figure>
                    <a href="item-page.php"><img src="images/tiny.jpg" alt="item3"></a>
                </figure>
                <div class="item-info">
                    <p>All-new Echo Dot (3rd Gen) - Smart speaker with Alexa - Charcoal</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>
                    <p>$100,000</p>
                </div>
                <button type="button" class="btn">Add to Cart</button>
            </div>

            <div class="entry">
                <figure>
                    <a href="item-page.php"><img src="images/tiny.jpg" alt="item3"></a>
                </figure>
                <div class="item-info">
                    <p>All-new Echo Dot (3rd Gen) - Smart speaker with Alexa - Charcoal</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>
                    <p>$100,000</p>
                </div>
                <button type="button" class="btn">Add to Cart</button>
            </div>

        </div>
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
