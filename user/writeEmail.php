<?php
//require_once '../admin/resetPassword.php';
include('../admin/resetPassword.php');
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
		<div class="container">
			<div id="login-row" class="row justify-content-center align-items-center">
				<div id="login-column" class="col-md-6">
					<div id="login-box" class="col-md-12">
						<form id="login-form" class="form" action="writeEmail.php" method="POST">
							<h3 class="text-center text-info">Forgot password</h3>
							<div class="form-group">
								<label for="femail" class="text-info">Email</label><br>
								<input type="text" name="femail" id="femail" class="form-control" placeholder="Type your email">
							</div>
							<div class="form-group">
                                <input type="submit" name="resetPass" class="btn btn-info btn-md" value="submit">
							</div>
							<?php if (count($messages) > 0)
							{
								?>
									<div class="form-group" style="color: red">
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
							<div id="" class="form-group">
								<a href="../index.php" class="text-info">Login</a>
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php include '../footer.php'; ?>
		</div>
	</body>
</html>