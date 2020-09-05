<?php
$count = 0;
$errors = [];
function validate_pass($passwd, $cpasswd)
{
	if($passwd == $cpasswd) 
	{
		$uppercase = preg_match('@[A-Z]@', $passwd);
		$lowercase = preg_match('@[a-z]@', $passwd);
		$number    = preg_match('@[0-9]@', $passwd);

		if(!$uppercase || !$lowercase || !$number ||  strlen($passwd) < 8) {
			array_push($errors, "Password should be at least 8 characters in length and should include at least one upper case letter, one number.");
		}
		else
		{
			$count = 1;
			return ($count);
		}
	}
	else{
		array_push($errors, "Password mismatch");
	}
}
?>