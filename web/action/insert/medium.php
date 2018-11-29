<?php

require '../../common/init.php';

$medium_name   = $_REQUEST['medium_name'];
$entity_name   = $_REQUEST['entity_name'];

if (isset($medium_name) && isset($entity_name)) {
	try {
		$sql = 'INSERT INTO medium (medium_number, medium_name, entity_name)
		        VALUES (DEFAULT, :name, :ename);';

		$result = prepare($sql);
		$result->execute(array(
			'name'   => $medium_name,
			'ename'  => $entity_name));

		$status = "Value successfully inserted: [ {$medium_name}, {$entity_name} ]";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$data = array(
	'result'  => query('SELECT * FROM medium
	                    ORDER BY entity_name, medium_number ASC;'),
	'caption' => 'Existing Mediums',
	'columns' => ['Medium Number', 'Medium Name', 'Entity Name'],
	'status'  => $status
);

echo template('insert/medium.view', $data);

