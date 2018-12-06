<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>YOUR NAME Grocery Order List</title>
<style>
	body{
	}
	table{
		width:60%;
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
		border-collapse: collapse;
	}

	td,th{
		padding:1em 2.5em;
		border: 1px solid #ddd;
	}
	#tableListOrder tr{
		border-bottom: 2px solid black;
	}
</style>
</head>
<body>

<?php

include 'include/db_credentials.php';
//TODO: replace natural join
/** Create connection, and validate that it connected successfully **/
function displayOrder($connection) {
$orderby = "";
$arrayTotalAmount = array();
//get total ammoun for all order id from array NOT NEEDED ANYMORE
$queryGetTotal = "SELECT sum(P.price * total_number) as total from Product P join OrderedProduct OP on P.pid = OP.pid group by order_id";
/*if($resultGetTotal = mysqli_query($connection,$queryGetTotal)){
	while($row = mysqli_fetch_assoc($resultGetTotal)){
		$arrayTotalAmount[] = $row['total'];

	}
}*/
	//set money format to dollar
	setlocale(LC_MONETARY, 'en_US.UTF-8');
	$counter = 0;

	$querySQLUpdated ="SELECT C.address, O.order_id,C.username,C.first_name,C.last_name,C.address,
	(SELECT sum(OP2.total_number * P.price)
	from Product P natural join OrderedProduct OP2
	where OP2.order_id=O.order_id) as total
	from Customer C natural join Orders O  join OrderedProduct OP on O.order_id = OP.order_id
	group by O.order_id";

	//$resultOrderId = mysqli_query($connection,$querySQL);
	$resultOrderId = mysqli_query($connection,$querySQLUpdated);
	echo "<table id=\"tableListOrder\" ><thead><tr><th>Order Id</th><th>Customer ID</th><th>Customer Name</th><th>Total Amount</th><th>Address</th></tr>";
	echo "</thead>";
	while ($row = mysqli_fetch_assoc($resultOrderId)) {
	// the keys match the field names from the table

	echo "<tr><td>".$row["order_id"]."</td>";

	//echo "<td>".$row["username"]."</td><td>".$row["first_name"]." ".$row["last_name"]."</td>"."<td>".$arrayTotalAmount[$counter]."</td>"."<td>".$row['address']."</td>";
	echo "<td>".$row["username"]."</td><td>".$row["first_name"]." ".$row["last_name"]."</td>"."<td>".formatMoney($row['total'])."</td>"."<td>".$row['address']."</td>";
	echo "</tr>";
	echo ("<tr><td colspan =\"5\"><table><tr><th>Product Id</th><th>Product Name</th><th>Quantity</th><th>Price</th></tr>");
	$curorder_id = (int)$row["order_id"];
	$queryProduct = "SELECT OP.pid,OP.total_number, P.price,P.pname from OrderedProduct OP join Product P on OP.pid = P.pid where OP.order_id =".$curorder_id;
	//print all products and their quantity for each order id
	if($result2 = mysqli_query($connection,$queryProduct)){
		while($row2 = mysqli_fetch_array($result2)){
			echo "<tr><td>".$row2[0]."</td>";
			echo("<td>". $row2[3] ."</td>");
			echo "<td>".$row2[1]."</td>";
			echo ("<td>".formatMoney($row2[2])."</td>");
			echo "</tr>";
		}
	}
	echo "</table>";
	// $counter+=1;
	echo "</td></tr>";
	}
	echo "</table>";
	/** Close connection **/
	mysqli_close($connection);
}
	function formatMoney($value) {
		return '$' . number_format($value, 2);
	}
?>

</body>
</html>
