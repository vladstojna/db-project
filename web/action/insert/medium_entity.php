<?php

require '../config.php';

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

require 'medium_entity.table.php';

require 'table.view.php';
require 'medium_entity.view.php';

