<?php

require '../../common/init.php';

$place_address = $_REQUEST['place_address'];

if (isset($place_address)) {
	try {
		$sql = 'DELETE FROM place WHERE place_address = :address;';

		$result = prepare($sql);
		$result->execute(array(':address' => $place_address));

		$status = "Value successfully deleted: {$place_address}";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$data = array(
	'result'  => query('SELECT * FROM place;'),
	'caption' => 'Places',
	'columns' => ['Address'],
	'inputs'  => ['place_address'],
	'prompt'  => 'Delete',
	'status'  => $status
);

echo template('table-single-prompt.view', $data);

