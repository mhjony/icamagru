<?php

$DB_DSN = "mysql:dbname=heroku_b52e11e37479cf3;host=eu-cdbr-west-03.cleardb.net";
$DB_USER = "ba720a4856594e";
$DB_PASSWORD = "91a05ca5";
$DB_DSN_NO_DB = "mysql:host=eu-cdbr-west-03.cleardb.net";

try
{
	$con = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	$con = NULL;
}
