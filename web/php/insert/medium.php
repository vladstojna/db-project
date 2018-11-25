<?php
	require '../config.php';
	require '../functions.php';

	if (isset($_GET['medium_number']) &&
		isset($_GET['medium_name'])   &&
		isset($_GET['entity_name'])) {
		try {
			$sql = "INSERT INTO medium (medium_number, medium_name, entity_name)
				VALUES (:number, :name, :ename);";

			$result = $db->prepare($sql);
			$result->bindParam(':number', $_GET['medium_number']);
			$result->bindParam(':name',   $_GET['medium_name']);
			$result->bindParam(':ename',  $_GET['entity_name']);
			$result->execute();

			$status = "<p> Value successfully inserted! </p>";
		}
		catch (PDOException $e) {
			$status = "<p>ERROR: {$e->getMessage()}</p>";
		}
	}

	$table = print_table($db, "SELECT * FROM medium;", "Mediums", ["medium_number", "medium_name", "entity_name"]);
	$db    = null;
?>

<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>

<?php if (isset($status)) echo $status; ?>

<form action="" method="GET">
	<label for="numInput"> Medium Number </label>
	<input id="numInput" type="text" name="medium_number" placeholder="Number...">

	<label for="nameInput"> Medium Name </label>
	<input id="nameInput" type="text" name="medium_name" placeholder="Name...">

	<label for="entityInput"> Entity </label>
	<input id="entityInput" type="text" name="entity_name" placeholder="Name...">

	<input type="submit" value="Insert">
</form>

<?php if (isset($table)) echo $table; ?>

</body>
</html>

