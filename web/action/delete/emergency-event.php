<?php

require '../../common/init.php';

if (isset($_GET['phone_number']) && isset($_GET['call_time'])) {
	try {
		$sql = "DELETE FROM emergency_event WHERE phone_number = :number AND call_time = :time;";

		$result = prepare($sql);
		$result->bindParam(':number',  $_GET['phone_number']);
		$result->bindParam(':time',    $_GET['call_time']);
		$result->execute();

		$status = "Value successfully deleted!";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$table = table_params(query("SELECT * FROM emergency_event"), "Emergency Events",
	["phone_number", "call_time", "person_name", "place_address", "rescue_process_number"],
	["phone_number", "call_time"]
);

include view('simple.view.php');

