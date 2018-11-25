<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
<?php
	try {
		include 'config.php';
		include 'functions.php';

		$sql =
			"SELECT DISTINCT medium_number, medium_name, entity_name
			FROM emergency_event
				NATURAL INNER JOIN triggers
				NATURAL INNER JOIN medium_rescue
				NATURAL INNER JOIN medium
			WHERE place_address = '$_REQUEST[place_address]';";

		print_table($db, $sql, "Triggered Rescue Mediums",
			["medium_number", "medium_name", "entity_name"]);

		echo("<a href=\"places_getmedium.php\">~ Go back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
?>
	</body>
</html>

