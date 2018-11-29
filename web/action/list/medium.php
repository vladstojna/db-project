<?php

require '../../common/init.php';

$data = array(
	'result'  => query('SELECT * FROM medium ORDER BY entity_name, medium_number ASC;'),
	'caption' => 'Mediums',
	'columns' => ['Medium Number', 'Medium Name', 'Entity Name']
);

echo template('table-single.view', $data);

