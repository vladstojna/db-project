<?php
	try {
		require_once 'config.php';
		require_once 'functions.php';

		$table = $_GET['table'];

		switch ($table) {

			case 'place':

				$sql = "SELECT place_address FROM place;";
				print_table($db, $sql, "Places", ["place_address"]);
				readfile("../forms/place.html");
				echo("<a href=\"../html/index_a.html\">~ Go back</a>");

				break;

			case 'emergency_event':

				$columns = "phone_number,call_time,person_name,place_address,rescue_process_number";
				$sql = "SELECT $columns FROM emergency_event;";
				print_table($db, $sql, "Emergency Events", explode(",", $columns));
				readfile("../forms/emergency_event.html");
				echo("<a href=\"../html/index_a.html\">~ Go back</a>");

				break;

			case 'rescue_process':

				$sql = "SELECT rescue_process_number FROM rescue_process;";
				print_table($db, $sql, "Rescue Processes", ["rescue_process_number"]);
				readfile("../forms/rescue_process.html");
				echo("<a href=\"../html/index_a.html\">~ Go back</a>");

				break;

			case 'medium_entity':

				$sql = "SELECT entity_name FROM medium_entity;";
				print_table($db, $sql, "Entities", ["entity_name"]);
				readfile("../forms/medium_entity.html");
				echo("<a href=\"../html/index_a.html\">~ Go back</a>");

				break;

			case 'medium':

				$columns = "medium_number,medium_name,entity_name";
				$sql = "SELECT $columns FROM medium;";
				print_table($db, $sql, "Places", explode(",", $columns));
				readfile("../forms/medium.html");
				echo("<a href=\"../html/index_a.html\">~ Go back</a>");

				break;

			case 'medium_combat':

				$sql = "SELECT medium_number, entity_name FROM medium_combat;";
				print_table($db, $sql, "Combat Mediums", ["medium_number", "entity_name"]);
				echo("<a href=\"../html/index_b.html\">~ Go back</a>");

				break;

			case 'medium_support':

				$sql = "SELECT medium_number, entity_name FROM medium_support;";
				print_table($db, $sql, "Support Mediums", ["medium_number", "entity_name"]);
				echo("<a href=\"../html/index_b.html\">~ Go back</a>");

				break;

			case 'medium_rescue':

				$sql = "SELECT medium_number, entity_name FROM medium_rescue;";
				print_table($db, $sql, "Rescue Mediums", ["medium_number", "entity_name"]);
				echo("<a href=\"../html/index_b.html\">~ Go back</a>");

				break;
		}

		$db = null;
		
	}
	catch (PDOException $e) {
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
?>

