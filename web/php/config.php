<html>
<?php
	$host = "xxxxx";
	$user = "xxxxx";
	$password = "xxxxx";
	$dbname   = $user;

	$db = new PDO("pgsql:host=$host; dbname=$dbname", $user, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>
</html>

