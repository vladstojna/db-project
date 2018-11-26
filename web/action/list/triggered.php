<?php
	if (isset($_GET['rescue_process_number'])) {
		require '../config.php';
		require '../functions.php';

		$sql =
			"SELECT medium_number, medium_name, entity_name
			FROM triggers NATURAL INNER JOIN medium
			WHERE rescue_process_number = $_GET[rescue_process_number];";

		$table = print_table($db, $sql, "Triggered Mediums",
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

