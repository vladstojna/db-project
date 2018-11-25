<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../../css/style.css">
	</head>
	<body>
<?php
	try {
		require_once '../config.php';

		$process_number = $_GET['rescue_process_number'];

		$sql = "INSERT INTO rescue_process VALUES ('{$process_number}');";

		$result = $db->prepare($sql);
		$result->execute();

		echo("<p> Value successfully inserted! </p>");

		echo("<a href=\"../action.php?table=rescue_process&action=insert\">~ Go back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
		echo("<a href=\"../action.php?table=rescue_process&action=insert\">~ Retry</a>");
	}
?>
	</body>
</html>

