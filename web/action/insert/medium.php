<?php

require '../../common/init.php';

if (isset($_GET['medium_number']) &&
	isset($_GET['medium_name'])   &&
	isset($_GET['entity_name'])) {
	try {
		$sql = "INSERT INTO medium (medium_number, medium_name, entity_name)
			VALUES (:number, :name, :ename);";

		$result = prepare($sql);
		$result->bindParam(':number', $_GET['medium_number']);
		$result->bindParam(':name',   $_GET['medium_name']);
		$result->bindParam(':ename',  $_GET['entity_name']);
		$result->execute();

		$status = "Value successfully inserted!";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$table = table_params(query("SELECT * FROM medium;"), "Mediums",
	["medium_number", "medium_name", "entity_name"]
);

include view('insert/medium.view.php');

