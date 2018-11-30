<?php

require '../../common/init.php';

$process = $_REQUEST['rescue_process_number'];

if (isset($process)) {
	try {
		$sql = 'DELETE FROM rescue_process WHERE process = :address;';

		$result = prepare($sql);
		$result->execute(array(':address' => $process));

		$status = "Value successfully deleted: {$process}";
	}
	catch (PDOException $e) {
		$status = exception_status($e);
	}
}

$data = array(
	'result'  => query('SELECT * FROM rescue_process;'),
	'caption' => 'Processes',
	'columns' => ['Process'],
	'inputs'  => ['rescue_process_number'],
	'prompt'  => 'Delete',
	'status'  => $status
);

echo template('table-single-prompt.view', $data);

