<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
	<h3>Database</h3>
<?php
	try {
		include 'config.php';

		$list_tables =
			"SELECT tablename FROM pg_catalog.pg_tables
			 WHERE schemaname = 'public' ORDER BY tablename ASC;";

		$result = $db->prepare($list_tables);
		$result->execute();

		echo("<table border=\"1\"\n");
		echo("<tr><td><b>Table Name</b></td></tr>\n");
		foreach($result as $row) {
			echo("<tr>\n");
			echo("<td>{$row['tablename']}</td>\n");
			echo("</tr>\n");
		}
		echo("</table>\n");

		echo("<a href=\"../index.html\">< Back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
?>
	</body>
</html>
