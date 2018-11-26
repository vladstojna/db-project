<?php
	require '../config.php';
	require '../functions.php';

	$table = print_table($db, "SELECT * FROM rescue_process;", "Rescue Processes", ["rescue_process_number"]);
	$db    = null;
?>

<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>

<a href="../../index.html"> ~ Back </a>

<?php if (isset($table)) echo $table; ?>

</body>
</html>

