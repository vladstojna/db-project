<?php

require '../../common/init.php';

if (isset($_GET['place_address'])) {
	try {
		$sql = "INSERT INTO place (place_address) VALUES (:address);";

		$result = prepare($sql);
		$result->bindParam(':address', $_GET['place_address']);
		$result->execute();

		$status = "Value successfully inserted!";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$table = table_params(query("SELECT * FROM place;"), "Places", ["place_address"]);

include view('insert/place.view.php');
