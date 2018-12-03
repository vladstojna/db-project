<?php

define("ROOT_DIR", __DIR__.'/..');

function template($file, $args=null) {
	$path = ROOT_DIR . '/views/' . $file . '.php';
	
	if (!file_exists($path))
		return null;

	if (is_array($args))
		extract($args);

	ob_start();
		include $path;
	return ob_get_clean();
}

