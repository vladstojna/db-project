<?php

require '../../common/init.php';

$medium_number = $_REQUEST['medium_number'];
$entity_name   = $_REQUEST['entity_name'];

if (isset($medium_number) && isset($entity_name)) {
	try {
		$sql = 'INSERT INTO medium_support (medium_number, entity_name)
		        VALUES (:number, :name);';

		$res = prepare($sql);
		$res->execute(array(
			':number' => $medium_number,
			':name'   => $entity_name));

		$status = "Medium successfully inserted: [ #{$medium_number}, {$entity_name} ]";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$data = array(
	'result' => query('SELECT * FROM medium AS m
	                   WHERE NOT EXISTS (
	                   SELECT * FROM medium_support mc
	                   WHERE m.medium_number = mc.medium_number
	                       AND m.entity_name = mc.entity_name)
	                   ORDER BY entity_name, medium_number ASC;'),
	'caption' => 'Candidate Mediums',
	'columns' => ['Medium Number', 'Medium Name', 'Entity Name'],
	'inputs'  => ['medium_number', 'entity_name'],
	'prompt'  => 'Insert',
	'status'  => $status
);

echo template('table-single-prompt.view', $data);

