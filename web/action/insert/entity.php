<?php

require '../../common/init.php';

if (isset($_GET['entity_name'])) {
	try {
		$sql = "INSERT INTO medium_entity (entity_name) VALUES (:name);";

		$result = $db->prepare($sql);
		$result->bindParam(':name', $_GET['entity_name']);
		$result->execute();

		$status = "Value successfully inserted!";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$table = table_params(query("SELECT * FROM medium_entity;"), "Entities", ["entity_name"]);

include view('insert/entity.view.php');

