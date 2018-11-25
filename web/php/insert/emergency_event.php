<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../../css/style.css">
	</head>
	<body>
<?php
	try {
		require_once '../config.php';

		$sql = "INSERT INTO emergency_event (phone_number, call_time, person_name, place_address)
			VALUES (:number, :time, :name, :address);";

		$result = $db->prepare($sql);
		$result->bindParam(':number',  $_GET['phone_number']);
		$result->bindParam(':time',    $_GET['call_time']);
		$result->bindParam(':name',    $_GET['person_name']);
		$result->bindParam(':address', $_GET['place_address']);
		$result->execute();

		echo("<p> Value successfully inserted! </p>");

		echo("<a href=\"../action.php?table=emergency_event&action=insert\">~ Go back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
		echo("<a href=\"../action.php?table=emergency_event&action=insert\">~ Retry</a>");
	}
?>
	</body>
</html>

