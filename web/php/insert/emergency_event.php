<?php
	require '../config.php';
	require '../functions.php';

	if (isset($_GET['phone_number']) &&
		isset($_GET['call_time'])    &&
		isset($_GET['person_name'])  &&
		isset($_GET['place_address'])) {
		try {
			$sql = "INSERT INTO emergency_event (phone_number, call_time, person_name, place_address)
				VALUES (:number, :time, :name, :address);";

			$result = $db->prepare($sql);
			$result->bindParam(':number',  $_GET['phone_number']);
			$result->bindParam(':time',    $_GET['call_time']);
			$result->bindParam(':name',    $_GET['person_name']);
			$result->bindParam(':address', $_GET['place_address']);
			$result->execute();

			$status = "Value successfully inserted!";
		}
		catch (PDOException $e) {
			$status = "ERROR: {$e->getMessage()}";
		}
	}
	$columns = ["phone_number", "call_time", "person_name", "place_address", "rescue_process_number"];
	$table = print_table($db, "SELECT * FROM emergency_event;", "Emergency Events", $columns);
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

	<label for="phoneInput"> Phone Number </label>
	<input id="phoneInput" type="text" name="phone_number" placeholder="e.g. 912345678" required>

	<label for="timeInput"> Call Time </label>
	<input id="timeInput" type="text" name="call_time" placeholder="HH:MM:SS" required>

	<label for="nameInput"> Caller </label>
	<input id="nameInput" type="text" name="person_name" placeholder="Name..." required>

	<label for"placeInput"> Place </label>
	<input id="placeInput" type="text" name="place_address" placeholder="Address" required>

	<input type="submit" value="Insert">
</form>

<?php if (isset($table)) echo $table; ?>

</body>
</html>

