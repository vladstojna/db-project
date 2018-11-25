<?php
	require '../config.php';
	require '../functions.php';

	$sql = "SELECT DISTINCT place_address
			FROM emergency_event NATURAL INNER JOIN triggers;";

	$table = print_table($db, $sql, "Rescue Mediums", ["place_address"],
		"triggered_rm.php", ["place_address"], "Get Rescue Mediums");

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

</body>
</html>

