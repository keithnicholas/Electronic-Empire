<header class="masthead">
        <div class="entry-header"><!--change p to div -->
            <nav class="navbar">
                <a href="main-page.php">HOME</a>
                <!-- <p> -->
                <form id="input-form" method="GET" action="itemList.php">
                    <input type="search" size="30" name="search_query" id = "search_query"placeholder="What are you looking for?">
                    <input type="submit" value="Search" class = "submit-search"/>
                </form>
                <!-- </p> -->
                <div class="top-right-navbar">
                    <a href="add-item-admin.php">ADD ITEM</a>
                    <a href="edit-item-admin.php">EDIT ITEM</a>
                    <a href = "logout.php">LOG OUT</a>
                    <a href="admin-view.php">ADMIN INFO</a>
                    <a href="admin-main.php">ADMIN MAIN</a>
                </div>
            </nav>
        </div>
</header>
