<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../../css/style.css">
	</head>
	<body>
<?php
	try {
		require_once '../config.php';

		$place = $_GET['place_address'];

		$sql = "INSERT INTO place VALUES ('{$place}');";

		$result = $db->prepare($sql);
		$result->execute();

		echo("<p> Value successfully inserted! </p>");

		echo("<a href=\"../action.php?table=place&action=insert\">~ Go back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
		echo("<a href=\"../action.php?table=place&action=insert\">~ Retry</a>");
	}
?>
	</body>
</html>

