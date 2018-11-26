<?php

require '../../common/init.php';

if (isset($_GET['phone_number']) &&
	isset($_GET['call_time'])    &&
	isset($_GET['person_name'])  &&
	isset($_GET['place_address'])) {
	try {
		$sql = "INSERT INTO emergency_event (phone_number, call_time, person_name, place_address)
			VALUES (:number, :time, :name, :address);";

		$result = prepare($sql);
		$result->bindParam(':number',  $_GET['phone_number']);
		$result->bindParam(':time',    $_GET['call_time']);
		$result->bindParam(':name',    $_GET['person_name']);
		$result->bindParam(':address', $_GET['place_address']);
		$result->execute();

		$status = "Value successfully inserted!";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

require '../../tables/emergency_event.table.php';
require '../../views/insert/emergency_event.view.php';

