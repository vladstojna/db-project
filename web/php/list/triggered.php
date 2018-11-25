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
			"SELECT medium_number, medium_name, entity_name
			FROM triggers NATURAL INNER JOIN medium
			WHERE rescue_process_number = $_REQUEST[rescue_process_number];";

		print_table($db, $sql, "Triggered Mediums", ["medium_number", "medium_name", "entity_name"]);

		echo("<a href=\"rp_getmedium.php\">~ Go back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
?>
	</body>
</html>

