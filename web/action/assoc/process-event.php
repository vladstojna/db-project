<?php

require '../../common/init.php';

$phone_number   = $_REQUEST['phone_number'];
$call_time      = $_REQUEST['call_time'];
$process_number = $_REQUEST['rescue_process_number'];

if (isset($phone_number) && isset($call_time) && isset($process_number)) {
	try {
		$sql = 'UPDATE emergency_event SET rescue_process_number = (:number)
		        WHERE phone_number = (:phone) AND call_time = (:time);';

		$result = prepare($sql);
		$result->execute(array(
			':phone'  => $phone_number,
			':time'   => $call_time,
			':number' => $process_number));

		$status = "Successfully associated rescue process #{$process_number} with event ({$phone_number}, {$call_time})";

	} catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$data = array(
	'result'  => query('SELECT phone_number, call_time, person_name, place_address
	                    FROM emergency_event WHERE rescue_process_number IS NULL;'),
	'title'   => 'Non-reserved Emergency Events',
	'columns' => ['Phone Number', 'Call Instant', 'Person Name', 'Place Address'],
	'inputs'  => ['phone_number', 'call_time'],
	'process' => query('SELECT * FROM rescue_process')->fetchAll(),
	'name'    => 'rescue_process_number',
	'status'  => $status
);

extract($data);

include view('assoc.view.php');
