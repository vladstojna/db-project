<?php

require '../../common/init.php';

if (isset($_GET['place_address'])) {
	try {
		$sql = "DELETE FROM place WHERE place_address = :address;";

		$result = prepare($sql);
		$result->bindParam(':address', $_GET['place_address']);
		$result->execute();

		$status = "Value successfully deleted!";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$table = table_params(query("SELECT * FROM place;"), "Places", ["place_address"], ["place_address"]);

include '../../views/simple.view.php';

