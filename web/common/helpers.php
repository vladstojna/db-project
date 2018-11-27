<?php

define("ROOT_DIR", __DIR__.'/..');

function view($file) {
	return ROOT_DIR . '/views/' . $file;
}

