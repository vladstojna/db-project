<?php
	try {
		require_once 'config.php';
		require_once 'functions.php';

		$table = $_GET['table'];

		$sql = "SELECT * FROM $table";

		$link = "delete/$table.php";

		$link_title = "Delete";

		switch ($table) {

			case 'place':

				$key = ["place_address"];
				print_table($db, $sql, "Places", $key, $link, $key, $link_title);

				break;

			case 'emergency_event':

				$columns = ["phone_number", "call_time", "person_name", "place_address", "rescue_process_number"];
				$key     = ["phone_number", "call_time"];
				print_table($db, $sql, "Emergency Events", $columns, $link, $key, $link_title);

				break;

			case 'rescue_process':

				$key = ["rescue_process_number"];
				print_table($db, $sql, "Rescue Processes", $key, $link, $key, $link_title);

				break;

			case 'medium_entity':

				$key = ["entity_name"];
				print_table($db, $sql, "Entities", $key, $link, $key, $link_title);

				break;

			case 'medium':

				$columns = ["medium_number", "medium_name", "entity_name"];
				$key     = ["medium_number", "entity_name"];
				print_table($db, $sql, "Mediums", $columns, $link, $key, $link_title);

				break;

			case 'medium_combat':

				print_table($db, $sql, "Combat Mediums", ["medium_number", "entity_name"]);

				break;

			case 'medium_support':

				print_table($db, $sql, "Support Mediums", ["medium_number", "entity_name"]);

				break;

			case 'medium_rescue':

				print_table($db, $sql, "Rescue Mediums", ["medium_number", "entity_name"]);

				break;
		}

		print_link("../index.html", "~ Go back");

		$db = null;

	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
?>

