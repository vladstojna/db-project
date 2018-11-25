<?php
	try {
		require_once 'config.php';
		require_once 'functions.php';

		$table = $_GET['table'];

		$sql = "SELECT * FROM $table";

		switch ($table) {

			case 'rescue_process':

				print_table($db, $sql, "Rescue Processes", ["rescue_process_number"]);
				break;

			case 'medium':

				print_table($db, $sql, "Mediums", ["medium_number", "medium_name", "entity_name"]);
				break;
		}

		print_link("../index.html", "~ Go back");

		$db = null;

	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
?>

