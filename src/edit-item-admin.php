<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>MyAmazon Store 3.0</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/additem.css">
    <script type="text/javascript" src="js/admin-add-item.js"></script>
</head>

<body>
  <?php include "include/admin-header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
  ?>
    <article id="item-bar">
        <h2>Edit Items</h2>
        <h3>Provide the item details on the following fields: </h3>
        <form method=POST id="add-item-form" action = "process-edit-item-admin.php">
            <p class="entry-additem-form">
                <label>Name of the Item:</label>
                <input type="text" class="additem-form" required name="item-name">
            </p>
            <p class="entry-additem-form">
                <label>Producer: </label>
                <input type="text" required name="producer-name" class="additem-form">
            </p>
            <p class="entry-additem-form"><label>Price: </label>
                <input type="number" class="additem-form" name="price-additem-name">
            </p>
            <p class="entry-additem-form"><label>Description</label>
                <textarea rows="6" cols="70" class="additem-form" placeholder="Enter Description here(Optional)"></textarea>
            </p>
            <div class="buttons-form-additem">
                <button type="submit"name="submit-button">Submit</button>
                <button type="reset" name="reset-button">Reset</button>
            </div>
        </form>
    </article>
  <?php include 'include/footer.php' ?>
</body>

</html>
