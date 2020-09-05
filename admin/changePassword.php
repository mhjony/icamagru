<?php
include('updateInfoValidation.php');
session_start();
$errors = [];
$messages = [];
//require_once '../config/dbConnection.php';
require_once 'dbConnectionNew.php';
if ($_SESSION['user'] != NULL)
{
if ($con)
{
	$user = $_SESSION['user']['username'];
	$query1= "SELECT * FROM `users` WHERE username=?";

	$result = $con->prepare($query1);
	$result->execute([$user]);
	$rows = $result->fetchAll();

	//$userInfo = mysqli_query($con, $query1);
	foreach ($rows as $row) {
		$lusername = $row['username'];
		$lemail = $row['email'];
		$lpass = $row['password'];
	}
	$oldPass = hash('sha256', $_POST['oldpasswd']);
	$newPass = $_POST['passwd'];
	$cnewPass = $_POST['cpasswd'];

	if ($_POST['submit'] === "Change Password")
	{
		if ($oldPass != "" && $newPass != "" && $cnewPass != "")
		{
			if ($oldPass === $lpass)
			{
				if ($newPass === $cnewPass){
					if  (ft_check_password($newPass, $cnewPass)){
					$newPassword = hash('sha256', $newPass);
					$sql = "UPDATE `users` SET password='$newPassword' WHERE username=?";
					$result = $con->prepare($sql);
					$result->execute([$user]);

					if ($result){
						array_push($messages, "Congrats! Your password has been changed");
					}
					else
						array_push($errors, "Database was not able to change your password");
				}
				else
					array_push($errors, "function returns zero");
				}
				else{
					array_push($errors, "New password mismatch");
				}
			}
			else{
				array_push($errors, "Your typed old passowrd is wrong");
			}
		}
		else{
			array_push($errors, "You have to fill the all fields");
		}
	}

}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Camagru</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="" media="screen"/>
	</head>
	<body>
		<?php
			include ('../user/header.php');
			?>
			<div id="login-row" class="row justify-content-center align-items-center">
				<div id="login-column" class="col-md-6">
					<div id="login-box" class="col-md-12">
						<form id="login-form" class="form" action="" method="POST">
							<h3 class="text-center text-info">Change your password</h3>
							<div class="form-group">
								<label for="password" class="text-info">Old Password:</label><br>
								<input type="password" name="oldpasswd" id="oldpasswd" class="form-control">
							</div>
							<div class="form-group">
								<label for="password" class="text-info">New Password:</label><br>
								<input type="password" name="passwd" id="passwd" class="form-control">
							</div>
							<div class="form-group">
								<label for="cpassword" class="text-info">Confirm New Password:</label><br>
								<input type="password" name="cpasswd" id="cpasswd" class="form-control">
							</div>
							<div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Change Password">
                            </div>
							<?php if (count($errors) > 0)
								{
									?>
										<div class="form-group" style="color: red">
											<?php foreach($errors as $error)
											{ ?>
												<ul>
													<li><?php echo $error; ?></li>
												</ul>
												<?php 
											} ?>
										</div>
									<?php
								}
							?>
							<?php if (count($messages) > 0)
								{
									?>
										<div class="form-group" style="color: green">
											<?php foreach($messages as $message)
											{ ?>
												<ul>
													<li><?php echo $message; ?></li>
												</ul>
												<?php 
											} ?>
										</div>
									<?php
								}
							?>
						</form>
					</div>
				</div>
			</div>
			<?php include '../footer.php'; ?>
		</div>
	</body>
</html>
<?php } 
else {
	header('Location: ../login_page.php');
}
?>