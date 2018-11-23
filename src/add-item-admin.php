<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>MyAmazon Store 3.0</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <!-- <link rel="stylesheet" href="style/form-style.css"> -->
    <link rel="stylesheet" href="style/additem.css">
    <script type="text/javascript" src="js/admin-add-item.js"></script>
</head>

<body>
  <?php include "include/admin-header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
  ?>
    <article id="item-bar">
        <h2>Add Items</h2>
        <h3>Provide the item details on the following fields: </h3>
        <form method=POST id="add-item-form">
            <p class="entry-additem-form">
                <label>Name of the Item:</label>
                <input type="text" class="additem-form" required name="item-name">
            </p>
            <p class="entry-additem-form">
                <label>Producer: </label>
                <input type="text" required name="producer-name" class="additem-form">
            </p>
            <p class="entry-additem-form"><label>Price: </label>
                <input type="number" class="additem-form" required name="price-additem-name">
            </p>
            <p class="entry-additem-form"><label>Description</label>
                <textarea rows="6" cols="70" class="additem-form" placeholder="Enter Description here" required name="description-additem"></textarea>
            </p>
            <p class="entry-additem-form">
                <label>Image(Optional): </label>
                <input type="file">
            </p>
            <div class="buttons-form-additem">
                <button type="submit" name="submit-button">Submit</button>
                <button type="reset"  name="reset-button">Reset</button>
            </div>
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
