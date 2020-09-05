<?php
require_once 'sendEmails.php';
$errors = [];
$messages = [];


if (isset($_POST['resetPass'])){
	if ($_POST['femail'] !== "")
	{
		require_once 'dbConnectionNew.php';
		
		if ($con) {
			$email = $_POST['femail'];
			// $sql = "SELECT *  FROM `users` WHERE email='$email';";
			// $results = mysqli_query($con, $sql);

			//$sql = "SELECT *  FROM `users` WHERE email='$email';";

			$query = "SELECT *  FROM `users` WHERE email=?;";
			$stmt = $con->prepare($query);
			$stmt->execute([$email]);
			$result = $stmt->fetch();
			
			if (!$result){
				//array_push($errors, "No user found with this email on our database");
				echo '<script type="text/JavaScript">  
        		alert("No user found with this email on our database"); 
        		</script>';
				header("Refresh: .1; url=../user/writeEmail.php");
				exit();
			}
			$token = bin2hex(random_bytes(50));
			if (count($errors) == 0){
				// $sql = "INSERT INTO reset_password (email, token) VALUES ('$email',  '$token');";
				// $results = mysqli_query($con, $sql);
				$sql = "INSERT INTO reset_password (email, token) VALUES (?,  ?);";
				$stmt = $con->prepare($sql);
				$stmt->execute([$email, $token]);
				sendResetMail($email, $token);
				array_push($messages, "An email has been sent to your email.");
				header('location: ../user/resetMessage.php?email=' .$email);
				//header("Refresh: 5; url=../user/writeEmail.php");
			}
		}
	}else{
		array_push($errors, "Please  write your email") ;
	}
}
?>

