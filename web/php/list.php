<?php
	try {
		require_once 'config.php';
		require_once 'functions.php';

		$table = $_GET['table'];

		switch ($table) {

			case 'rescue_process':

				$sql = "SELECT rescue_process_number FROM rescue_process;";
				print_table($db, $sql, "Rescue Processes", ["rescue_process_number"]);
				echo("<a href=\"../html/index_c.html\">~ Go back</a>");

				break;

			case 'medium':

				$columns = "medium_number,medium_name,entity_name";
				$sql = "SELECT $columns FROM medium;";
				print_table($db, $sql, "Mediums", explode(",", $columns));
				echo("<a href=\"../html/index_c.html\">~ Go back</a>");

				break;
		}

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
?>

