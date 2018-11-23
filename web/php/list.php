<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
	<h3>Table: <?=$_REQUEST['tablename']?> </h3>
<?php
	try {
		$host     = "db.ist.utl.pt";
		$user     = "ist186526";
		$password = "toud1659";
		$dbname   = $user;

		$db = new PDO("pgsql:host=$host; dbname=$dbname", $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$table = <?=$_REQUEST['tablename']?>

		$sql = "SELECT * FROM $table;";

		$result = $db->prepare($sql);
		$result->execute();

		echo("<table border=\"1\" cellspacing=\"5\">\n");
		echo("<tr><td><b> $table </b></td></tr>\n");
		foreach($result as $row) {
			echo("<tr>\n");
			echo("<td>{$row['table']}</td>\n");
			echo("</tr>\n");
		}
		echo("</table>\n");

		echo("<a href=\"test.php\"><- Back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
?>
	</body>
</html>
