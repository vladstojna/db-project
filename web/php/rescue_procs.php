<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
<?php
	try {
		include 'config.php';

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

