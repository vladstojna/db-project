<?php

require '../../common/init.php';

$place = $_REQUEST['place_address'];

if (isset($place)) {
	try {
		$sql = 'SELECT DISTINCT medium_number, medium_name, entity_name
		        FROM emergency_event
		            NATURAL INNER JOIN triggers
		            NATURAL INNER JOIN medium_rescue
		            NATURAL INNER JOIN medium
		        WHERE place_address = :address
		        ORDER BY entity_name, medium_number ASC;';

		$result = prepare($sql);
		$result->execute(array(':address' => $place));

	} catch (PDOException $e) {
		$status = exception_status($e);
	}
}

$data = array(
	'helper' => query('SELECT DISTINCT place_address
	                   FROM emergency_event NATURAL INNER JOIN triggers
	                   ORDER BY place_address ASC;'),
	'caption_helper' => 'Choose a place',
	'helpercols'     => ['Place'],
	'inputs'         => ['place_address'],

	'result'  => $result,
	'caption' => 'Triggered Rescue Mediums',
	'columns' => ['Medium Number', 'Medium Name', 'Entity Name'],
	'status'  => $status
);

echo template('table-dual.view', $data);

