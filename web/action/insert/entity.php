<?php

require '../../common/init.php';

$entity = $_REQUEST['entity_name'];

if (isset($entity)) {
	try {
		$sql = 'INSERT INTO medium_entity (entity_name) VALUES (:name);';

		$result = prepare($sql);
		$result->execute(array(
			':name' => $entity));

		$status = "Value successfully inserted: {$entity}";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$data = array(
	'result'  => query('SELECT * FROM medium_entity;'),
	'caption' => 'Existing Entities',
	'columns' => ['Entity Name'],
	'status'  => $status
);

echo template('insert/entity.view', $data);

