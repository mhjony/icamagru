<?php
include '../config/dbConnectionNew.php';
include '../admin/sendEmails.php';
session_start();

function ft_image_owner_email($con, $imageid)
{
	$query = "SELECT users.email AS email FROM `users` JOIN images ON images.user_id = users.user_id JOIN tbl_comment ON images.id = tbl_comment.image_id WHERE images.id = ? LIMIT 1";
	$stmt = $con->prepare($query);
	$stmt->execute([$imageid]);
	$results = $stmt->fetchAll();

	foreach($results as $res)
	{
		$email = $res['email'];
	}
	return ($email);
}

if ($_POST['submit'] == "Comment")
{
	$user = $_SESSION['user']['user_id'];
	$text = $_POST['comm'];
	$imageid = $_GET['imageid'];
	$sql = "INSERT INTO `tbl_comment` (`user_id`, `comment`, `image_id`) VALUES (?, ?, ?)";
	$stmt= $con->prepare($sql);
	$stmt->execute([$user, $text, $imageid]);
	//$stmt->rowCount();
	$email = ft_image_owner_email($con, $imageid);

	$sql1 = "SELECT recieveCommEmail FROM `users` WHERE email=?";
	$res = $con->prepare($sql1);
	$res->execute([$email]);
	$result = $res->fetch();
	if ($result['recieveCommEmail'] == '1')
		commentEmail($email, $imageid);
	header("Location: ../controller/likes.php?imageid=$imageid");
	exit();
}

