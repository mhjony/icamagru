<?php
session_start();
//include('../config/dbConnection.php');
//print_r($_SESSION);
if ($_SESSION['user'] != NULL)
{
	header('Location: ../controller/gallery.php');
}else{
	header('Location: ../index.php');
}