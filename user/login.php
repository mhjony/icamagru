<?php
require 'dbConnectionNew.php';
$errors = [];

if (isset($_POST['submit']))
{
	if ($_POST['submit'] == "Log in")
	{
		if (!isset($_POST['username'], $_POST['password']))
		{
			exit('Please fill both the username and password fields!');
		}
		$username = $_POST['username'];
		$password = hash('sha256', $_POST['password']);

		$result = $con->prepare("SELECT * FROM users WHERE (`username`=? OR `email`=?) AND `password`= ?");
		$result->execute([$username, $username, $password]);
		$user = $result->fetch();

		session_start();
		if ($user)
		{
			if ($user['verified'] == 1)
			{
				$user = array(
					'username' => $user['username'],
					'name' => $user['name'],
					'email' => $user['email'],
					'user_id' => $user['user_id']
				);
				$_SESSION['user'] = $user;
				header('location: ../camagru/user/userHome.php');
				die();
			}
			else
				array_push($errors, "You have to verify your account");
		}else 
		{
			array_push($errors, "Wrong username/password combination");
		}
	}
}
?>