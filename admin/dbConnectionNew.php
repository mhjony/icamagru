<?php

$DB_DSN = "mysql:dbname=camagru;host=127.0.0.1";
$DB_USER = "root";
$DB_PASSWORD = "123456";
$DB_DSN_NO_DB = "mysql:host=127.0.0.1";

try
{
	$con = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	$con = NULL;
}
