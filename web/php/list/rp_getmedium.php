<?php
	require '../config.php';
	require '../functions.php';

	$sql = "SELECT rescue_process_number FROM rescue_process;";

	$table = print_table($db, $sql, "Rescue Processes", ["rescue_process_number"],
		"rp_getmedium.php", ["rescue_process_number"], "Get Triggered Mediums");

	if (isset($_GET['rescue_process_number'])) {

		$sql_final =
			"SELECT medium_number, medium_name, entity_name
			FROM triggers NATURAL INNER JOIN medium
			WHERE rescue_process_number = $_GET[rescue_process_number];";

		$table_final = print_table($db, $sql_final, "Triggered Mediums", ["medium_number", "medium_name", "entity_name"]);
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

