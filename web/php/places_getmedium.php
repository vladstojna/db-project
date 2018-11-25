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

		$sql = "SELECT DISTINCT place_address
				FROM emergency_event NATURAL INNER JOIN triggers;";

		print_table($db, $sql, "Rescue Mediums", ["place_address"],
			"triggered_rm.php", ["place_address"], "Get Rescue Mediums");

		echo("<a href=\"../index.html\">~ Go back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
?>
	</body>
</html>

