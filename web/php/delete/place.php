<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../../css/style.css">
	</head>
	<body>
<?php
	try {
		require_once '../config.php';

		$sql = "DELETE FROM place WHERE place_address = :address;";

		$result = $db->prepare($sql);
		$result->bindParam(':address', $_GET['place_address']);
		$result->execute();

		echo("<p> Value successfully deleted! </p>");

		echo("<a href=\"../action.php?table=place&action=delete\">~ Go back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
		echo("<a href=\"../action.php?table=place&action=delete\">~ Retry</a>");
	}
?>
	</body>
</html>

