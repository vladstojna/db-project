<?php

require '../../common/init.php';

if (isset($_GET['rescue_process_number'])) {
	try {
		$sql = "INSERT INTO rescue_process (rescue_process_number) VALUES (:number);";

		$result = $db->prepare($sql);
		$result->bindParam(':number', $_GET['rescue_process_number']);
		$result->execute();

		$status = "Value successfully inserted!";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$table = table_params(query("SELECT * FROM rescue_process;"), "Rescue Processes",
	["rescue_process_number"]
);

include view('insert/rescue-process.view.php';

