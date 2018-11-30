<?php

$host     = "xxx";
$user     = "xxx";
$password = "xxx";
$dbname   = $user;

$db = new PDO("pgsql:host=$host; dbname=$dbname", $user, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


function query($sql) {
	return $GLOBALS['db']->query($sql);
}

function prepare($sql) {
	return $GLOBALS['db']->prepare($sql);
}

function begin_transaction() {
	$GLOBALS['db']->beginTransaction();
}

function commit() {
	$GLOBALS['db']->commit();
}

function rollback() {
	$GLOBALS['db']->rollBack();
}

function transaction(...$queries) {
	begin_transaction();
	foreach ($queries as $sql)
		$result = query($sql);
	commit();
}

function exception_status($e) {
	$msg  = explode('DETAIL: ', $e->getMessage());
	$code = $e->getCode();
	return "ERROR {$code}: {$msg[1]}";
}

