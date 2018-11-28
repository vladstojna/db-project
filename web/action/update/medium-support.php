<?php

require '../../common/init.php';

$medium_number = $_REQUEST['medium_number'];
$old_entity    = $_REQUEST['entity_name'];
$new_name      = $_REQUEST['new_name'];
$new_entity    = $_REQUEST['new_entity'];

if (isset($medium_number) && isset($old_entity) && isset($new_entity)) {
	try {
		if (empty($new_name)) {
			$sql = 'UPDATE medium_support SET entity_name = :new_entity
			        WHERE medium_number = :number AND entity_name = :old_entity;';

			/*
			$result = prepare($sql);
			$result->execute(array(
				':new_entity' => $new_entity,
				':number'     => $medium_number,
				':old_entity' => $old_entity));
			*/

			$status = "Successfully edited medium #{$medium_number}: {$old_entity} -> {$new_entity}";
		}

	} catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$data = array(
	'result'  => query('SELECT * FROM medium NATURAL INNER JOIN medium_support;'),
	'title'   => 'Edit Support Mediums',
	'columns' => ['Medium Number', 'Entity Name', 'Medium Name', 'New Medium Name', 'New Entity'],
	'inputs'  => ['medium_number', 'entity_name'],
	'entity'  => query('SELECT * FROM medium_entity
	                    WHERE entity_name NOT IN (
	                        SELECT entity_name FROM medium_support);')->fetchAll(PDO::FETCH_COLUMN, 0),

	'name'        => 'new_entity',
	'm_name'      => 'new_name',
	'placeholder' => '(Optional) new medium name...',
	'status'      => $status
);

extract($data);

include view('update-medium.view.php');

