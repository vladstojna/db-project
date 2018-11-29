<?php

require '../../common/init.php';

$medium_number = $_REQUEST['medium_number'];
$old_entity    = $_REQUEST['entity_name'];
$old_name      = $_REQUEST['medium_name'];
$new_name      = $_REQUEST['new_name'];
$new_entity    = $_REQUEST['new_entity'];

if (isset($medium_number) && isset($old_entity) && isset($new_entity)) {
	try {
		$sql = 'UPDATE medium SET medium_name = :new_name entity_name = :new_entity
				WHERE medium_number = :number AND entity_name = :old_entity;';

		if (isset($new_name) && $new_name != "")
			$status = "Successfully edited medium #{$medium_number}:
			           [ {$old_entity} -> {$new_entity} ] and
			           [ {$old_name} -> {$new_name} ]";
		else {
			$new_name = $old_name;
			$status = "Successfully edited medium #{$medium_number}: {$old_entity} -> {$new_entity}";
		}

		/*
		$result = prepare($sql);
		$result->execute(array(
			':new_name'   => $new_name;
			':new_entity' => $new_entity,
			':number'     => $medium_number,
			':old_entity' => $old_entity));
		*/

	} catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

$data = array(
	'result'  => query('SELECT * FROM medium NATURAL INNER JOIN medium_combat
	                    ORDER BY entity_name, medium_number ASC;'),
	'title'   => 'Edit Combat Mediums',
	'columns' => ['Medium Number', 'Entity Name', 'Medium Name', 'New Medium Name', 'New Entity'],
	'inputs'  => ['medium_number', 'entity_name', 'medium_name'],
	'entity'  => query('SELECT * FROM medium_entity
	                    WHERE entity_name NOT IN (
	                        SELECT entity_name FROM medium_combat);')->fetchAll(PDO::FETCH_COLUMN, 0),

	'name'        => 'new_entity',
	'm_name'      => 'new_name',
	'placeholder' => '(Optional) new medium name...',
	'status'      => $status
);

echo template('update-medium.view', $data);

