<?php

$medium_number = $_REQUEST['medium_number'];
$entity_name   = $_REQUEST['entity_name'];

if (isset($medium_number) && isset($entity_name)) {
	try {
		$sql = "DELETE FROM $table WHERE medium_number = :number AND entity_name = :name;";

		$result = prepare($sql);
		$result->execute(array(
			':number' => $medium_number,
			':name'   => $entity_name));

		$status = "Value successfully deleted: [ #{$medium_number}, {$entity_name} ]";
	}
	catch (PDOException $e) {
		$status = exception_status($e);
	}
}

$data = array(
	'result'  => query("SELECT * FROM {$table} NATURAL INNER JOIN medium;"),
	'caption' => $caption,
	'columns' => ['Medium Number', 'Medium Name', 'Entity Name'],
	'inputs'  => ['medium_number', 'entity_name'],
	'prompt'  => 'Delete',
	'status'  => $status
);

echo template('table-single-prompt.view', $data);

