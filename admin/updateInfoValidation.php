<?php
$errors = "";
function ft_check_username($username){
	$count = 0;
	if (preg_match("/^([a-zA-Z0-9]+)$/", trim ($username))){
		if (strlen(trim($username)) < 6)
		{
			array_push($errors, "Username should be at least 6 characters");
		}
		else
		{
			$count = 1;
		}
	}
	else{
		//echo "Username should only contain letters and numbers!";
		array_push($errors, "Username should only contain letters and numbers!");
	}
	return ($count);
}

function ft_check_password($passwd, $cpasswd){
	$count = 0;
	if(!empty($passwd) && !empty($cpasswd) && ($passwd == $cpasswd)) {
		$uppercase = preg_match('@[A-Z]@', $passwd);
		$lowercase = preg_match('@[a-z]@', $passwd);
		$number    = preg_match('@[0-9]@', $passwd);

		if(!$uppercase || !$lowercase || !$number ||  strlen($passwd) < 8) {
			echo "Password should be at least 8 characters in length and should include at least one upper case letter, one number.";
		}
		else
		{
			if ($passwd == $cpasswd)
			{
				$count = 1;
			}
			else{
				array_push($errors, "Password mismatch");
			}
		}
	}
	return ($count);
}

function ft_check_email($email)
{
	$count = 0;
	if (isset($email) && $email != ""){
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$count =  1;
		}
		else{
			array_push($errors, "Invalid email format");
		}
	}
	return ($count);
}
?>