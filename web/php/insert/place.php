<?php
	require '../config.php';
	require '../functions.php';

	if (isset($_GET['place_address'])) {
		try {
			$sql = "INSERT INTO place (place_address) VALUES (:address);";

			$result = $db->prepare($sql);
			$result->bindParam(':address', $_GET['place_address']);
			$result->execute();

			$status = "<p> Value successfully inserted! </p>";
		}
		catch (PDOException $e) {
			$status = "<p>ERROR: {$e->getMessage()}</p>";
		}
	}

	$table = print_table($db, "SELECT * FROM place;", "Places", ["place_address"]);
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
	<label for="in"> Place </label>
	<input id="in" type="text" name="place_address" placeholder="Address...">
	<input type="submit" value="Insert">
</form>

<?php if (isset($table)) echo $table; ?>

</body>
</html>

