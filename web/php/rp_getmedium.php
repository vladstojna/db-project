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

		$sql = "SELECT rescue_process_number FROM rescue_process;";

		print_table($db, $sql, "Rescue Processes", ["rescue_process_number"],
			"triggered.php", ["rescue_process_number"], "Get Triggered Mediums");

		echo("<a href=\"../index.html\">~ Go back</a>");

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
?>
	</body>
</html>

