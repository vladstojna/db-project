<?php
	require '../config.php';
	require '../functions.php';

	$sql = "SELECT DISTINCT place_address
			FROM emergency_event NATURAL INNER JOIN triggers;";

	$table = print_table($db, $sql, "Rescue Mediums", ["place_address"],
		"places_getmedium.php", ["place_address"], "Get Rescue Mediums");

	if (isset($_GET['place_address'])) {

		$sql_final =
			"SELECT DISTINCT medium_number, medium_name, entity_name
			FROM emergency_event
				NATURAL INNER JOIN triggers
				NATURAL INNER JOIN medium_rescue
				NATURAL INNER JOIN medium
			WHERE place_address = '$_GET[place_address]';";

		$table_final = print_table($db, $sql_final, "Triggered Rescue Mediums",
			["medium_number", "medium_name", "entity_name"]);
	}

	$db = null;
?>

<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>

<a href="../../index.html"> ~ Back </a>

<?php if(isset($table)) echo $table; ?>

<?php if(isset($table_final)) echo $table_final; ?>

</body>
</html>

