<?php

/* php mapper: from index to particular script */

require_once 'common/init.php';

/* get data sent by user */

if (isset($_REQUEST['action']) && isset($_REQUEST['data'])) {

	/* get extra information if exists */

	if (isset($_REQUEST['subdata']))
		$subdata = $_REQUEST['subdata'];

	/* include file */

	require_once ROOT_DIR . '/action/' . $_REQUEST['action'] . $_REQUEST['data'] . '.php';
}

