<?php

require '../../common/init.php';

if (isset($_GET['entity_name'])) {
	try {
		$sql = "DELETE FROM medium_entity WHERE entity_name = :name;";

		$result = $db->prepare($sql);
		$result->bindParam(':name', $_GET['entity_name']);
		$result->execute();

		$status = "Value successfully deleted!";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$table = table_params(query("SELECT * FROM medium_entity;"), "Entities", ["entity_name"],
	["entity_name"]
);

include '../../views/simple.view.php';

