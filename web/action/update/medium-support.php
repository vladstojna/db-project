<?php

require '../../common/init.php';

/* Sets variables from form */
$medium_number = $_REQUEST['medium_number'];
$old_entity    = $_REQUEST['entity_name'];
$old_name      = $_REQUEST['medium_name'];
$new_name      = $_REQUEST['new_name'];
$new_entity    = $_REQUEST['new_entity'];

/* if variables are valid then prepare & execute query; treats exception */
if (isset($medium_number) && isset($old_entity) && isset($new_entity)) {
	try {
		$sql = 'UPDATE medium SET medium_name = :new_name, entity_name = :new_entity
				WHERE medium_number = :number AND entity_name = :old_entity;';

		if (isset($new_name) && $new_name != "")
			$status = "Successfully edited medium #{$medium_number}:
			           entity [ {$old_entity} -> {$new_entity} ] and
			           name [ {$old_name} -> {$new_name} ]";
		else {
			$new_name = $old_name;
			$status = "Successfully edited medium #{$medium_number}:
			           entity [ {$old_entity} -> {$new_entity} ]";
		}

		$result = prepare($sql);
		$result->execute(array(
			':new_name'   => $new_name,
			':new_entity' => $new_entity,
			':number'     => $medium_number,
			':old_entity' => $old_entity));

	} catch (PDOException $e) {
		$status = "ERROR: {$e->getMessage()}";
	}
}

/* Gets all possible new entities per row (excludes the one the medium currently belongs to)  */
$entity_filter = [];
$filter_base =
	query('SELECT entity_name FROM medium_support ORDER BY entity_name ASC;')->fetchAll(PDO::FETCH_COLUMN, 0);
foreach ($filter_base as $entry) {
	$result = prepare('SELECT * FROM medium_entity WHERE entity_name <> :entry;');
	$result->execute([':entry' => $entry]);
	$entity_filter[] = $result->fetchAll(PDO::FETCH_COLUMN, 0);
}

/* Build data array to pass to template */
$data = array(
	'result'  => query('SELECT * FROM medium NATURAL INNER JOIN medium_support
	                    ORDER BY entity_name, medium_number ASC;'),
	'title'   => 'Edit Support Mediums',
	'columns' => ['Medium Number', 'Entity Name', 'Medium Name', 'New Medium Name', 'New Entity'],
	'inputs'  => ['medium_number', 'entity_name', 'medium_name'],
	'entity_filter' => $entity_filter,
	'name'        => 'new_entity',
	'm_name'      => 'new_name',
	'placeholder' => '(Optional) new medium name...',
	'status'      => $status
);

/* Echo template */
echo template('update-medium.view', $data);

