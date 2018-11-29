<?php

define("ROOT_DIR", __DIR__.'/..');

function view($file) {
	return ROOT_DIR . '/views/' . $file;
}

function template($file, $args) {
	$path = ROOT_DIR . '/views/' . $file . '.php';
	
	if (!file_exists($path))
		return null;

	if (is_array($args))
		extract($args);

	ob_start();
		include $path;
	return ob_get_clean();
}

