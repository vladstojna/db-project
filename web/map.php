<?php

/* php mapper: from index to particular script */

/* get data sent by user */

$action = $_REQUEST['action'];
$data   = $_REQUEST['data'];

if (isset($action) && !empty($action) && isset($data) && !empty($data)):

	header('Location: action/'.$action.'/'. $data.'.php');

else: ?>

<html>
<body>
	<h1> Nothing to do here <h1>
</body
</html>

<?php endif ?>

