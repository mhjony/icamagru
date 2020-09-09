<?php
session_start();
include '../config/dbConnectionNew.php';

if($_POST['submit'] == "Like"){
	$userId = $_SESSION['user']['user_id'];
	$id = $_GET['imageid'];
	$results = $con->prepare("INSERT INTO likes (`image_id`, `user_id`) VALUES ($id, $userId)");
	$results->execute();

	$results = $con->prepare("UPDATE images SET like_count = like_count + 1 WHERE `id`=$id");
	$results->execute();
	header("Location: ../controller/likes.php?imageid=$id");
	//exit();
}

if ($_POST['submit'] == "Unlike")
{
	$userId = $_SESSION['user']['user_id'];
	$id = $_GET['imageid'];
	$results = $con->prepare("DELETE FROM likes WHERE `image_id`=$id AND `user_id`=$userId");
	$results->execute();

	$un_like = $con->prepare("UPDATE images SET like_count = like_count - 1 WHERE `id`=$id");
	$un_like->execute();
}


