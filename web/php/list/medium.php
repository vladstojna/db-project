<?php
	require '../config.php';
	require '../functions.php';

	$table = print_table($db, "SELECT * FROM medium;", "Mediums", ["medium_number", "medium_name", "entity_name"]);
	$db    = null;
?>

<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>

<?php if (isset($table)) echo $table; ?>

</body>
</html>

