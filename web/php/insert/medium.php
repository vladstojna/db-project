<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../../css/style.css">
	</head>
	<body>
<?php
	try {
		require_once '../config.php';

		$sql = "INSERT INTO medium (medium_number, medium_name, entity_name)
			VALUES (:number, :name, :ename);";

		$result = $db->prepare($sql);
		$result->bindParam(':number', $_GET['medium_number']);
		$result->bindParam(':name',   $_GET['medium_name']);
		$result->bindParam(':ename',  $_GET['entity_name']);
		$result->execute();

		echo("<p> Value successfully inserted! </p>");

		echo("<a href=\"../action.php?table=medium&action=insert\">~ Go back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
		echo("<a href=\"../action.php?table=medium&action=insert\">~ Retry</a>");
	}
?>
	</body>
</html>

