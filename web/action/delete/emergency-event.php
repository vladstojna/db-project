<?php

require '../../common/init.php';

$phone_number = $_REQUEST['phone_number'];
$call_time    = $_REQUEST['call_time'];

if (isset($phone_number) && isset($call_time)) {
	try {
		$sql = 'DELETE FROM emergency_event WHERE phone_number = :number AND call_time = :time;';

		$result = prepare($sql);
		$result->execute(array(
			':number' => $phone_number,
			':time'   => $call_time));

		$status = "Value successfully deleted: [ {$phone_number}, {$call_time} ]";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$data = array(
	'result'  => query('SELECT * FROM emergency_event;'),
	'caption' => 'Emergency Events',
	'columns' => ['Phone Number', 'Call Instant', 'Person Name', 'Place Address', 'Rescue Process Number'],
	'inputs'  => ['phone_number', 'call_time'],
	'prompt'  => 'Delete',
	'status'  => $status
);

echo template('table-single-prompt.view.view', $data);

