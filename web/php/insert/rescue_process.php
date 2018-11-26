<?php
	require '../config.php';
	require '../functions.php';

	if (isset($_GET['rescue_process_number'])) {
		try {
		$sql = "INSERT INTO rescue_process (rescue_process_number) VALUES (:number);";

		$result = $db->prepare($sql);
		$result->bindParam(':number', $_GET['rescue_process_number']);
		$result->execute();

		$status = "Value successfully inserted!";
		}
		catch (PDOException $e) {
			$status = "ERROR: {$e->getMessage()}";
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

<a href="../../index.html"> ~ Back </a>

<?php if (isset($status)) ?>
	<p> <?=$status?> </p>

<form action="" method="GET">
	<label for="in"> Rescue Process </label>
	<input id="in" type="text" name="rescue_process_number" placeholder="Number..." required>
	<input type="submit" value="Insert">
</form>

<?php if (isset($table)) echo $table; ?>

</body>
</html>

