
<?php
	require '../config.php';
	require '../functions.php';

	if (isset($_GET['place_address'])) {
		try {
			$sql = "DELETE FROM place WHERE place_address = :address;";

			$result = $db->prepare($sql);
			$result->bindParam(':address', $_GET['place_address']);
			$result->execute();
			
			$status = "<p> Value successfully deleted! </p>";
		}
		catch (PDOException $e) {
			$status = "<p>ERROR: {$e->getMessage()}</p>";
		}
	}

	$table = print_table($db, "SELECT * FROM place;", "Places", ["place_address"],
			"place.php", ["place_address"], "Delete");
	$db    = null;
?>

<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>

<a href="../../index.html"> ~ Back </a>

<?php if (isset($status)) echo $status ?>
<?php if (isset($table)) echo $table ?>

</body>
</html>

