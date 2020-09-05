<?php
//require_once 'signup.php';
$input_count = 0;
$errors = [];
if ($_POST['fullname'] != "" && $_POST['username'] != "" && $_POST['email'] != "" && $_POST["passwd"] != "" && $_POST['cpasswd'] != "")
{
	if (isset($_POST['fullname']) && $_POST['fullname'] != ""){
		if(preg_match("/^([a-zA-Z' ]+)$/",trim($_POST['fullname']))){
			$var_name = trim($_POST['fullname']);
			++$input_count;
		}else{
			array_push($errors, "Invalid name given.");
		}
	}

	if (isset($_POST['username']) && $_POST['username'] != ""){
		if (preg_match("/^([a-zA-Z0-9]+)$/", trim ($_POST['username']))){
			if (strlen(trim($_POST['username'])) < 6)
			{
				array_push($errors, "Username should be at least 6 characters");
			}
			else
			{
				$var_user = $_POST['username'];
				++$input_count;
			}
		}
		else{
			array_push($errors,"Username should only contain letters and numbers!");
		}
	}

	if (isset($_POST['email']) && $_POST['email'] != ""){
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$var_email = $_POST['email'];
			++$input_count;
		}
		else{
			array_push($errors, "Invalid email format");
		}
	}

	if(!empty($_POST["passwd"]) && !empty($_POST["cpasswd"]) && ($_POST["passwd"] == $_POST["cpasswd"])) {
		$uppercase = preg_match('@[A-Z]@', $_POST['passwd']);
		$lowercase = preg_match('@[a-z]@', $_POST['passwd']);
		$number    = preg_match('@[0-9]@', $_POST['passwd']);

		if(!$uppercase || !$lowercase || !$number ||  strlen($_POST['passwd']) < 8) {
			array_push($errors, "Password should be at least 8 characters in length and should include at least one upper case letter, one number.");
		}
		else
		{
			if ($_POST["passwd"] == $_POST["cpasswd"])
			{
				$var_passwd = $_POST['passwd'];
				++$input_count;
			}
			else{
				array_push($errors, "Password mismatch");
			}
		}
	}
}
