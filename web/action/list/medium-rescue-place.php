<?php

require '../../common/init.php';

if (isset($_GET['place_address'])) {

	$sql =
		"SELECT DISTINCT medium_number, medium_name, entity_name
		FROM emergency_event
			NATURAL INNER JOIN triggers
			NATURAL INNER JOIN medium_rescue
			NATURAL INNER JOIN medium
		WHERE place_address = :address;";

	$result = prepare($sql);
	$result->bindParam(':address', $_GET['place_address']);
	$result->execute();

	$result = table_params($result, "Triggered Rescue Mediums",
		["medium_number", "medium_name", "entity_name"]
	);

}

$sql = "SELECT DISTINCT place_address
		FROM emergency_event NATURAL INNER JOIN triggers;";

$helper = table_params(query($sql), "Places", ["place_address"], ["place_address"]);

include view('dual.view.php');

