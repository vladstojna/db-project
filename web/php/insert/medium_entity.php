<?php
	require '../config.php';
	require '../functions.php';

	if (isset($_GET['entity_name'])) {
		try {
			$sql = "INSERT INTO medium_entity (entity_name) VALUES (:name);";

			$result = $db->prepare($sql);
			$result->bindParam(':name', $_GET['entity_name']);
			$result->execute();

			$status = "<p> Value successfully inserted! </p>";
		}
		catch (PDOException $e) {
			$status = "<p>ERROR: {$e->getMessage()}</p>";
		}
	}

	$table = print_table($db, "SELECT * FROM medium_entity;", "Entities", ["entity_name"]);
	$db    = null;
?>

<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>

<?php if (isset($status)) echo $status; ?>

<form action=""  method="GET">
	<label for="in"> Entity </label>
	<input id="in" type="text" name="entity_name" placeholder="Name...">
	<input type="submit" value="Insert">
</form>

<?php if (isset($table)) echo $table; ?>

</body>
</html>

