<?php

/* php mapper: from index to particular script */

/* get data sent by user */

$action = $_POST['action'];
$data   = $_POST['data'];

if (isset($action) && !empty($action) && isset($data) && !empty($data)):

	$all_data = array(
		'place',
		'emergency-event',
		'rescue-process',
		'medium',
		'entity',
		'medium-combat',
		'medium-rescue',
		'medium-support');

	$updatable_data = array(
		'medium-combat',
		'medium-rescue',
		'medium-support');

	$assoc_data = array(
		'process-event',
		'process-medium');

	$valid = false;

	if (($action == 'insert' || $action == 'delete') && $action != 'update'):
		$valid = in_array($data, $all_data);
	elseif ($action == 'assoc' && action != 'update'):
		$valid = in_array($data, $assoc_data);
	else:
		$valid = in_array($data, $updatable_data);
	endif;

	if ($valid):
		header('Location: action/'.$action.'/'. $data.'.php');
	endif;

endif;

?>

<html>
<body>
	<h1> Nothing to do here <h1>
</body
</html>

