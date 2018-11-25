<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
<?php
	$action = $_GET['action'];

	switch ($action) {
		/* In case of insertion */
		case 'insert':
			include 'insert.php';
			break;
		/* In case of deletion */
		case 'delete':
			include 'delete.php';
			break;
		/* In case of edit */
		case 'edit':
			include 'update.php';
			break;
		/* When associating rescue processes */
		case 'associate':
			include 'associate.php';
			break;
		/* When listing a relation */
		case 'list':
			include 'list.php';
			break;
	}
?>
	</body>
</html>

