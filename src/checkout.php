<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>MyAmazon Store 3.0-Item-List</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/checkout-style.css">
    <script type="text/javascript" src="js/checkout.js"></script>
    <script src = "http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src = "js/jquery-3.1.1.min.js"></script>
</head>

<body>
  <?php include "include/header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
  ?>

    <main>
        <div id="item-bar">

            <h3>ShoppingCart</h3>

            <div class="entry">
                <figure>
                    <a href="item-page.php">
                        <img src="images/example-mazda3.jpg" alt="item1">
                    </a>
                </figure>
                <div class="item-info">
                    <h4>All-new Echo Dot (3rd Gen) - Smart speaker with Alexa - Charcoal</h4>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>
                    <div class="keep-or-remove">
                        <h4>$100,000</h4>
                        <button value="Remove">Remove</button>
                        <p class="text-quantity">Quantity</p>
                        <input type="number" class="item-quantity" name="item-quantity" value="1">
                    </div>
                </div>
            </div>

            <div class="entry">
                <figure>
                    <a href="item-page.php">
                        <img src="images/example-mazda3.jpg" alt="item1">
                    </a>
                </figure>
                <div class="item-info">
                    <h4>All-new Echo Dot (3rd Gen) - Smart speaker with Alexa - Charcoal</h4>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>
                    <div class="keep-or-remove">
                        <h4>$100,000</h4>
                        <button value="Remove">Remove</button>
                        <p class="text-quantity">Quantity</p>
                        <input type="number" class="item-quantity" name="item-quantity" value="1">
                    </div>
                </div>
            </div>

            <div class="entry">
                <figure>
                    <a href="item-page.php">
                        <img src="images/example-mazda3.jpg" alt="item1">
                    </a>
                </figure>
                <div class="item-info">
                    <h4>All-new Echo Dot (3rd Gen) - Smart speaker with Alexa - Charcoal</h4>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>
                    <div class="keep-or-remove">
                        <h4>$100,000</h4>
                        <button value="Remove">Remove</button>
                        <p class="text-quantity">Quantity</p>
                        <input type="number" class="item-quantity" name="item-quantity" value="1">
                    </div>
                </div>
            </div>

            <div class="entry">
                <figure>
                    <a href="item-page.php">
                        <img src="images/example-mazda3.jpg" alt="item1">
                    </a>
                </figure>
                <div class="item-info">
                    <h4>All-new Echo Dot (3rd Gen) - Smart speaker with Alexa - Charcoal</h4>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>
                    <div class="keep-or-remove">
                        <h4>$100,000</h4>
                        <button value="Remove">Remove</button>
                        <p class="text-quantity">Quantity</p>
                        <input type="number" class="item-quantity" name="item-quantity" value="1">
                    </div>
                </div>
            </div>

            <div class="entry" id="cancel-entry-div">
                <form method="POST" id="checkout-form">
                    <label>Subtotal:<span id="subtotal">$400,000</span></label>
                    <input type="button" id="checkout" class="btn" value="Checkout">
                </form>
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
