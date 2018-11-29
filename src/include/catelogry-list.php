<?php
    //TODO: generate category list dynamicly

    include 'db_credentials.php';
    $sql = "SELECT category FROM Product GROUP BY category ORDER BY category";
    $con = mysqli_connect($host, $db_user, $db_pw, $database);
    if (mysqli_connect_errno()) { //if cannot connect
      exit("<p>cannot connect to DB: " . mysqli_connect_error . '</p>');
    }
    $stmt = mysqli_query($con, $sql);
    echo("<article id=\"category-bar\"><h3 id=\"cate-ls\">Category List</h3><nav>");
    while($row = mysqli_fetch_row($stmt)) {
      echo ("<a href = \"itemList.php?category=".$row[0]."\">".$row[0]."</a>");
    }
    echo("</nav></article>");
?>
