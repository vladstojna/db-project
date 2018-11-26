<?php

require '../config.php';

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

require 'rescue_process.table.php';

require 'table.view.php';
require 'rescue_process.view.php';

