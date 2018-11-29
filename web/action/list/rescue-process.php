<?php

require '../../common/init.php';

$data = array(
	'result'  => query('SELECT * FROM rescue_process;'),
	'caption' => 'Rescue Processes',
	'columns' => ['Process']
);

echo template('table-single.view', $data);

