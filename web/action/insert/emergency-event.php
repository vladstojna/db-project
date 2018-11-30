<?php

require '../../common/init.php';

$phone_number = $_REQUEST['phone_number'];
$call_time    = $_REQUEST['call_time'];
$person_name  = $_REQUEST['person_name'];
$address      = $_REQUEST['place_address'];

if (isset($phone_number) && isset($call_time) && isset($person_name) && isset($address)) {
	try {
		$sql = 'INSERT INTO emergency_event (phone_number, call_time, person_name, place_address)
		        VALUES (:number, :time, :name, :address);';

		$result = prepare($sql);
		$result->execute(array(
			':number'  => $phone_number,
			':time'    => $call_time,
			':name'    => $person_name,
			':address' => $address));

		$status = "Value successfully inserted:
		           [ {$phone_number}, {$call_time}, {$person_name}, {$address} ]";
	}
	catch (PDOException $e) {
		$status = exception_status($e);
	}
}

$data = array(
	'result'  => query('SELECT phone_number, call_time, person_name, place_address
	                    FROM emergency_event
	                    ORDER BY call_time DESC;'),
	'select'  => query('SELECT * FROM place;')->fetchAll(PDO::FETCH_COLUMN, 0),
	'caption' => 'Existing Emergency Events',
	'columns' => ['Phone Number', 'Call Instant', 'Person Name', 'Place Address'],
	'status'  => $status
);

echo template('insert/emergency-event.view', $data);

