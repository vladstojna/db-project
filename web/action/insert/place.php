<?php

require '../../common/init.php';

$place = $_REQUEST['place_address'];

if (isset($place)) {
	try {
		$sql = 'INSERT INTO place (place_address) VALUES (:address);';

		$result = prepare($sql);
		$result->execute(array(
			':address' => $place));

		$status = "Value successfully inserted: {$place}";
	}
	catch (PDOException $e) {
		$status = exception_status($e);
	}
}

$data = array(
	'result'  => query('SELECT * FROM place;'),
	'caption' => 'Existing Places',
	'columns' => ['Address'],
	'status'  => $status
);

echo template('insert/place.view', $data);

