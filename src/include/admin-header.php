<header class="masthead">
        <div class="entry-header"><!--change p to div -->
            <nav class="navbar">
                <a href="main-page.php">Home</a>
                <!-- <p> -->
                <form id="input-form" method="GET" action="itemList.php">
                    <input type="search" size="30" name="search_query" id = "search_query"placeholder="What are you looking for?">
                    <input type="submit" value="Search" class = "submit-search"/>
                </form>
                <!-- </p> -->
                <div class="top-right-navbar">
                    <a href="add-item-admin.php">Add Item</a>
                    <a href="edit-item-admin.php">Edit Item</a>
                    <a href = "logout.php">Log Out</a>
                    <a href="admin-user-control.php">Control</a>
                    <a href="admin-main.php">Admin Center</a>
                </div>
            </nav>
        </div>
</header>
