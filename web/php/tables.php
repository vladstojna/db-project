<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
<?php
	try {
		include 'config.php';
		include 'functions.php';

		$list_tables =
			"SELECT tablename FROM pg_catalog.pg_tables
			 WHERE schemaname = 'public' ORDER BY tablename ASC;";

		print_table($db, $list_tables, "Database", ["tablename"]);

		echo("<a href=\"../index.html\">~ Go back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
?>
	</body>
</html>
