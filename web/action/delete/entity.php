<?php

require '../../common/init.php';

$entity_name = $_REQUEST['entity_name'];

if (isset($entity_name)) {
	try {
		$sql = 'DELETE FROM medium_entity WHERE entity_name = :name;';

		$result = prepare($sql);
		$result->execute(array(':name' => $entity_name));

		$status = "Value successfully deleted: {$entity_name}";
	}
	catch (PDOException $e) {
		$status = exception_status($e);
	}
}

$data = array(
	'result'  => query('SELECT * FROM medium_entity;'),
	'caption' => 'Entities',
	'columns' => ['Entity Name'],
	'inputs'  => ['entity_name'],
	'prompt'  => 'Delete',
	'status'  => $status
);

echo template('table-single-prompt.view', $data);

