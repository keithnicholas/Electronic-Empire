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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>
  <?php include "include/admin-header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
        include "listorder.php";

        //secure admin pages
        session_start();
        if(!isset($_SESSION['username']) ||isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 0){
            echo("<h1 align = center>You do not have access to this page</h1>");
            exit();
        }
        $con = mysqli_connect($host, $db_user, $db_pw, $database);
        if (mysqli_connect_errno()) { //if cannot connect
          exit("<p>cannot connect to DB: " . mysqli_connect_error . '</p>');
        }

        // $sql = "SELECT username, COUNT(*) as total FROM Comment GROUP BY username";
        $sql = "SELECT pname, SUM(total_number) AS total FROM OrderedProduct NATURAL JOIN Product GROUP BY pname";
        $result = mysqli_query($con, $sql);
  ?>

    <article id="item-bar">
      <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Username','Total'],
              <?php
              while($row = mysqli_fetch_array($result)) {
                echo "['".$row['pname']."',".$row['total']."],";
              }
              ?>
            ]);
        var options = {'title':'Product Market Share Summary',
         'width':400, 'height':200,
          pieHole:0.3};
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
        }
        </script>

      <?php
      if(isset($_SESSION['username'])&&isset($_SESSION['isAdmin'])//admin permission check
       &&$_SESSION['isAdmin'] == 1){
          $username = $_SESSION['username'];
      }
      echo("<h2 align=center>Welcome Back ".$_SESSION['username']."</h2>");

      //graph && charts
      echo "<div id = \"piechart\"></div>";
      echo "<div id = \"barchart_values\"></div>";

      echo("<form method = \"POST\" id = \"add-item-form\">
      <p class = \"entry-additem-form\">
      <input type = \"submit\" name = \"order\" value = \"Order Summary\"/></p></form>");
      if(isset($_POST['order'])) {
        displayOrder($con);
      }
      //reset database with sql script
      echo("<form method = \"POST\" id = \"add-item-form\" action = \"LoadData.php\">
      <p class = \"entry-additem-form\">
      <input type = \"submit\" name = \"reset\" value = \"RESET DATABASE\"/></p></form>");
      ?>
    </article>
    <?php include 'include/footer.php' ?>
</body>

</html>
