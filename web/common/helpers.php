<?php

define("ROOT_DIR", __DIR__.'/..');

function view($file) {
	return ROOT_DIR . '/views/' . $file;
}

function style($css) {
	return ROOT_DIR . '/css/' . $css;
}

