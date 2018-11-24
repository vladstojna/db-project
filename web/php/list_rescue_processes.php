<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
<?php
	try {
		$host     = "db.ist.utl.pt";
		$user     = "ist186526";
		$password = "jzfw0082";
		$dbname   = $user;

		$db = new PDO("pgsql:host=$host; dbname=$dbname", $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT rescue_process_number FROM rescue_process;";

		$result = $db->prepare($sql);
		$result->execute();

		echo("<table border=\"1\"\n");
		echo("<tr><td><b> Rescue Process Number (ID) </b></td></tr>\n");
		foreach($result as $row) {
			echo("<tr>\n");
			echo("<td>{$row['rescue_process_number']}</td>\n");
			echo("</tr>\n");
		}
		echo("</table>\n");

		echo("<a href=\"../html/index_c.html\">~ Go back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
?>
	</body>
</html>

