<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
<?php
	try {
		include 'config.php';

		$sql =
			"SELECT DISTINCT medium_number, medium_name, entity_name
			FROM emergency_event
				NATURAL INNER JOIN triggers
				NATURAL INNER JOIN medium_rescue
				NATURAL INNER JOIN medium
			WHERE place_address = '$_REQUEST[place_address]';";

		$result = $db->prepare($sql);
		$result->execute();

		echo("<table border=\"1\"\n");
		echo("<tr><td>");
		echo("<b>Medium Number</b>");
		echo("</td><td>");
		echo("<b>Medium Name</b>");
		echo("</td><td>");
		echo("<b>Entity Name</b>");
		echo("</td></tr>\n");
		foreach($result as $row) {
			echo("<tr>\n");
			echo("<td>{$row['medium_number']}</td>\n");
			echo("<td>{$row['medium_name']}</td>\n");
			echo("<td>{$row['entity_name']}</td>\n");
			echo("</tr>\n");
		}
		echo("</table>\n");

		echo("<a href=\"places_getmedium.php\">~ Go back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
?>
	</body>
</html>

