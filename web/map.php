<?php

/* php mapper: from index to particular script */

require_once 'common/init.php';

/* get data sent by user */

if (isset($_REQUEST['action']) && isset($_REQUEST['data'])) {
	$action = $_REQUEST['action'];
	$data   = $_REQUEST['data'];
}

require_once ROOT_DIR . '/action/' . $action . '/' . $data . '.php';

