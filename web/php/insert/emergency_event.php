<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../../css/style.css">
	</head>
	<body>
<?php
	try {
		require_once '../config.php';

		$phone_number = $_GET['phone_number'];
		$call_time    = $_GET['call_time'];
		$person_name  = $_GET['person_name'];
		$place        = $_GET['place_address'];

		$sql = "INSERT INTO emergency_event
			VALUES ({$phone_number}, '{$call_time}', '{$person_name}', '{$place}');";

		$result = $db->prepare($sql);
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

