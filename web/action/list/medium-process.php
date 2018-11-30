<?php

require '../../common/init.php';

$process = $_REQUEST['rescue_process_number'];

if (isset($process)) {
	try {
		$sql = 'SELECT medium_number, medium_name, entity_name
		        FROM triggers NATURAL INNER JOIN medium
		        WHERE rescue_process_number = :number;';

		$result = prepare($sql);
		$result->execute(array(':number' => $process));

	} catch (PDOException $e) {
		$status = exception_status($e);
	}
}

$data = array(
	'helper' => query('SELECT DISTINCT rescue_process_number
	                   FROM rescue_process NATURAL INNER JOIN triggers
	                   ORDER BY rescue_process_number ASC;'),
	'caption_helper' => 'Choose a rescue process',
	'helpercols'     => ['Process'],
	'inputs'         => ['rescue_process_number'],

	'result'  => $result,
	'caption' => 'Triggered Mediums',
	'columns' => ['Medium Number', 'Medium Name', 'Entity Name'],
	'status'  => $status
);

echo template('table-dual.view', $data);

