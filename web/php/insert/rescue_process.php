<?php
	require '../config.php';
	require '../functions.php';

	if (isset($_GET['rescue_process_number'])) {
		try {
		$sql = "INSERT INTO rescue_process (rescue_process_number) VALUES (:number);";

		$result = $db->prepare($sql);
		$result->bindParam(':number', $_GET['rescue_process_number']);
		$result->execute();

		$status = "<p> Value successfully inserted! </p>";
		}
		catch (PDOException $e) {
			$status = "<p>ERROR: {$e->getMessage()}</p>";
		}
	}

	$table = print_table($db, "SELECT * FROM rescue_process;", "Rescue Processes", ["rescue_process_number"]);
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
	<label for="in"> Rescue Process </label>
	<input id="in" type="text" name="rescue_process_number" placeholder="Number...">
	<input type="submit" value="Insert">
</form>

<?php if (isset($table)) echo $table; ?>

</body>
</html>

