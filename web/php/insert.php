<?php
	try {
		require_once 'config.php';
		require_once 'functions.php';

		$table = $_GET['table'];

		$sql = "SELECT * FROM $table";

		switch ($table) {

			case 'place':

				print_table($db, $sql, "Places", ["place_address"]);
				readfile("../forms/place.html");

				break;

			case 'emergency_event':

				$columns = ["phone_number", "call_time", "person_name", "place_address", "rescue_process_number"];
				print_table($db, $sql, "Emergency Events", $columns);
				readfile("../forms/emergency_event.html");

				break;

			case 'rescue_process':

				print_table($db, $sql, "Rescue Processes", ["rescue_process_number"]);
				readfile("../forms/rescue_process.html");

				break;

			case 'medium_entity':

				print_table($db, $sql, "Entities", ["entity_name"]);
				readfile("../forms/medium_entity.html");

				break;

			case 'medium':

				$columns = ["medium_number", "medium_name", "entity_name"];
				print_table($db, $sql, "Mediums", $columns);
				readfile("../forms/medium.html");

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

