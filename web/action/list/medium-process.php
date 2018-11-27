<?php

require '../../common/init.php';

if (isset($_GET['rescue_process_number'])) {

	$sql =
		"SELECT medium_number, medium_name, entity_name
		FROM triggers NATURAL INNER JOIN medium
		WHERE rescue_process_number = :number;";

	$result = prepare($sql);
	$result->bindParam(':number', $_GET['rescue_process_number']);
	$result->execute();

	$result = table_params($result, "Triggered Mediums",
		["medium_number", "medium_name", "entity_name"]);

}

$helper = table_params(
	query("SELECT rescue_process_number FROM rescue_process;"),
	"Rescue Processes",
	["rescue_process_number"],
	["rescue_process_number"]
);

include view('dual.view.php');

