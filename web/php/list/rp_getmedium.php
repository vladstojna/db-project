<?php
	require '../config.php';
	require '../functions.php';

	$sql = "SELECT rescue_process_number FROM rescue_process;";

	$table = print_table($db, $sql, "Rescue Processes", ["rescue_process_number"],
		"triggered.php", ["rescue_process_number"], "Get Triggered Mediums");

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

