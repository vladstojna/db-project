<?php

require '../../common/init.php';

$phone_number = $_REQUEST['phone_number'];
$call_time    = $_REQUEST['call_time'];

if (isset($phone_number) && isset($call_time)) {
	try {
		begin_transaction();

		query('INSERT INTO rescue_process (rescue_process_number) VALUES (DEFAULT);');

		$res = prepare('
			UPDATE emergency_event
			SET rescue_process_number = (
			    SELECT MAX(rescue_process_number)
			    FROM rescue_process)
			WHERE phone_number = :number AND call_time = :time;');

		$res->execute(array(
			':number' => $phone_number,
			':time'   => $call_time));

		commit();

		$status = "Rescue process successfully inserted at [ {$phone_number}, {$call_time} ]";
	}
	catch (PDOException $e) {
		rollback();
		$status = exception_status($e);
	}
}

$data = array(
	'result'  => query('SELECT phone_number, call_time, person_name, place_address FROM emergency_event
	                    WHERE rescue_process_number IS NULL
	                    ORDER BY call_time DESC;'),
	'caption' => 'Emergency Events available',
	'columns' => ['Phone Number', 'Call Instant', 'Person Name', 'Place Address', 'Process'],
	'inputs'  => ['phone_number', 'call_time'],
	'prompt'  => 'Insert here',
	'status'  => $status
);

echo template('table-single-prompt.view', $data);

