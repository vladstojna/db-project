<?php

require '../../common/init.php';

if (isset($_GET['phone_number']) && isset($_GET['call_time'])) {
	try {

		begin_transaction();

		query('INSERT INTO rescue_process (rescue_process_number) VALUES (DEFAULT);');

		$res =
			prepare('
			UPDATE emergency_event
			SET rescue_process_number = (
				SELECT MAX(rescue_process_number)
				FROM rescue_process)
			WHERE phone_number = :number AND call_time = :time;'
			);

		$res->bindParam(':number', $_GET['phone_number']);
		$res->bindParam(':time', $_GET['call_time']);
		$res->execute();

		commit();

		$status = 'Rescue process successfully inserted!';
	}
	catch (PDOException $e) {
		rollback();
		$status = "ERROR: {$e->getMessage()}";
	}
}

$helper = table_params(query('SELECT * FROM emergency_event WHERE rescue_process_number IS NULL;'),
	'Available for insertion',
	['phone_number', 'call_time', 'person_name', 'place_address', 'rescue_process_number'],
	['phone_number', 'call_time']
);

$result = table_params(query('SELECT * FROM emergency_event WHERE rescue_process_number IS NOT NULL;'),
	'Reserved',
	['phone_number', 'call_time', 'person_name', 'place_address', 'rescue_process_number']
);

include view('dual.view.php');

