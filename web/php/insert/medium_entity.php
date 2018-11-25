<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../../css/style.css">
	</head>
	<body>
<?php
	try {
		require_once '../config.php';

		$sql = "INSERT INTO medium_entity (entity_name) VALUES (:name);";

		$result = $db->prepare($sql);
		$result->bindParam(':name', $_GET['entity_name']);
		$result->execute();

		echo("<p> Value successfully inserted! </p>");

		echo("<a href=\"../action.php?table=medium_entity&action=insert\">~ Go back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
		echo("<a href=\"../action.php?table=medium_entity&action=insert\">~ Retry</a>");
	}
?>
	</body>
</html>

