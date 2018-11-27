<?php

require '../../common/init.php';

if (isset($_GET['rescue_process_number'])) {
	try {
		$sql = "DELETE FROM rescue_process WHERE rescue_process_number = :number;";

		$result = prepare($sql);
		$result->bindParam(':number', $_GET['rescue_process_number']);
		$result->execute();

		$status = "Value successfully deleted!";
	}
	catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$table = table_params(query("SELECT * FROM rescue_process;"), "Rescue Processes",
	["rescue_process_number"], ["rescue_process_number"]
);

include view('simple.view.php');

