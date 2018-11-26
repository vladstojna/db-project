<?php
	require '../config.php';
	require '../functions.php';

	if (isset($_GET['entity_name'])) {
		try {
			$sql = "INSERT INTO medium_entity (entity_name) VALUES (:name);";

			$result = $db->prepare($sql);
			$result->bindParam(':name', $_GET['entity_name']);
			$result->execute();

			$status = "Value successfully inserted!";
		}
		catch (PDOException $e) {
			$status = "ERROR: {$e->getMessage()}";
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

<a href="../../index.html"> ~ Back </a>

<?php if (isset($status)) ?>
	<p> <?=$status?> </p>

<form action=""  method="GET">
	<label for="in"> Entity </label>
	<input id="in" type="text" name="entity_name" placeholder="Name..." required>
	<input type="submit" value="Insert">
</form>

<?php if (isset($table)) echo $table; ?>

</body>
</html>

