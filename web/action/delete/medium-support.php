<?php

require '../../common/init.php';

if (isset($_GET['medium_number']) && isset($_GET['entity_name'])) {
	try {
		$sql = "DELETE FROM medium_support WHERE
			medium_number = :number AND entity_name = :name;";

		$result = prepare($sql);
		$result->bindParam(':number', $_GET['medium_number']);
		$result->bindParam(':name',  $_GET['entity_name']);
		$result->execute();

		$status = "Value successfully deleted!";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$table = table_params(
	query("
		SELECT * FROM medium_support NATURAL INNER JOIN medium;"),
	"Support Mediums",
	["medium_number", "medium_name", "entity_name"],
	["medium_number", "entity_name"]
);

include view('simple.view.php');

