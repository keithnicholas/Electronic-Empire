<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
	include 'include/db_credentials.php';
	$con = mysqli_connect($host, $db_user, $db_pw, $database);

	echo("<h1>Connecting to database.</h1><p>");
	if(mysqli_connect_errno()){ //if cannot connect
			exit("<p>cannot connect to DB: ".mysqli_connect_error.'</p>');
	}
	$fileName = "create.sql";
	$file = file_get_contents($fileName, true);
		$file = mb_convert_encoding($file, 'UTF-8', mb_detect_encoding($file, 'UTF-8, ISO-8859-1', true));
	$lines = explode(";", $file);
	echo("<ol>");
	foreach ($lines as $line){
		$line = trim($line);
		if($line != ""){
			echo("<li>".$line . ";</li><br/>");
			mysqli_query($con, $line);
		}
	}
	mysqli_close($con);
	echo("</p><h2>Database loading complete!</h2>");
?>
</body>
</html>
