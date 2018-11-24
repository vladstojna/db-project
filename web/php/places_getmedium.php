<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
<?php
	try {
		include 'config.php';

		$sql = "SELECT DISTINCT place_address
				FROM emergency_event NATURAL INNER JOIN triggers;";

		$result = $db->prepare($sql);
		$result->execute();

		echo("<table border=\"1\"\n");
		echo("<tr><td><b> Place Address </b></td></tr>\n");
		foreach($result as $row) {
			echo("<tr>\n");
			echo("<td>{$row['place_address']}</td>\n");
			echo("<td><a href=\"triggered_rm.php?place_address={$row['place_address']}\">
				Get Rescue Mediums</a></td>\n");
			echo("</tr>\n");
		}
		echo("</table>\n");

		echo("<a href=\"../index.html\">~ Go back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
?>
	</body>
</html>

