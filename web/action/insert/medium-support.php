<?php

require '../../common/init.php';

if (isset($_GET['medium_number']) && isset($_GET['entity_name'])) {
	try {
		$sql = "INSERT INTO medium_support (medium_number, entity_name)
			VALUES (:number, :name);";

		$result = prepare($sql);
		$result->bindParam(':number', $_GET['medium_number']);
		$result->bindParam(':name',  $_GET['entity_name']);
		$result->execute();

		$status = "Value successfully inserted!";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$helper = table_params(
	query("
		SELECT * FROM medium m
		WHERE NOT EXISTS (
			SELECT * FROM medium_support mc
			WHERE m.medium_number = mc.medium_number
				AND m.entity_name = mc.entity_name
		);"),
	"Candidates",
	["medium_number", "medium_name", "entity_name"],
	["medium_number", "entity_name"]
);

$result = table_params(
	query("SELECT * FROM medium_support NATURAL INNER JOIN medium"),
	"Combat Mediums",
	["medium_number", "medium_name", "entity_name"]
);

include view('dual.view.php');

