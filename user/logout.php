<?php
session_start();
unset($_SESSION['user']);
$_SESSION['user'] = NULL;
if (!($_SESSION['user']))
	header('Location: ../index.php');
session_destroy();
?>