<?php

require '../../common/init.php';

$medium_number  = $_REQUEST['medium_number'];
$entity_name    = $_REQUEST['entity_name'];
$process_number = $_REQUEST['rescue_process_number'];

if (isset($medium_number) && isset($entity_name) && isset($process_number)) {
	try {
		$sql = 'INSERT INTO triggers (medium_number, entity_name, rescue_process_number)
		        VALUES (:number, :name, :process);';

		$result = prepare($sql);
		$result->execute(array(
			':number'  => $medium_number,
			':name'    => $entity_name,
			':process' => $process_number));

		$status = "Successfully associated rescue process #{$process_number} with medium #{$medium_number} from {$entity_name})";

	} catch (PDOException $e) {
		$status = exception_status($e);
	}
}

$data = array(
	'result'  => query('SELECT * FROM medium AS m
	                    WHERE NOT EXISTS (
	                        SELECT * FROM triggers AS t WHERE
	                        m.medium_number = t.medium_number AND m.entity_name = t.entity_name)
	                    ORDER BY entity_name, medium_number ASC;'),
	'title'   => 'Available Mediums',
	'columns' => ['Medium Number', 'Medium Name', 'Entity Name', 'Process'],
	'inputs'  => ['medium_number', 'entity_name'],
	'process' => query('SELECT * FROM rescue_process')->fetchAll(),
	'name'    => 'rescue_process_number',
	'status'  => $status
);

echo template('process-assoc.view', $data);

