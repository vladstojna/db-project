<?php
	if (isset($_GET['place_address'])) {
		require '../config.php';
		require '../functions.php';

		$sql =
			"SELECT DISTINCT medium_number, medium_name, entity_name
			FROM emergency_event
				NATURAL INNER JOIN triggers
				NATURAL INNER JOIN medium_rescue
				NATURAL INNER JOIN medium
			WHERE place_address = '$_GET[place_address]';";

		$table = print_table($db, $sql, "Triggered Rescue Mediums",
			["medium_number", "medium_name", "entity_name"]);

		$db = null;
	}
?>

<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>

<a href="../../index.html"> ~ Back </a>

<?php if(isset($table)) echo $table; ?>

</body>
</html>

