<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/header.css">
</head>
<body>

<div class="topnav" id="myTopnav">
  <?php if ($_SESSION['user'] != NULL) { ?>
		<a href="../controller/gallery.php" class="active">GALLERY</a>
  <?php }
  else { ?>
    <a href="index.php" class="active">Home</a>
  <?php } ?>
	<?php if ($_SESSION['user'] != NULL) { ?>
		<a href="../controller/webcam.php">Profile</a>
	<?php } ?>
  	<?php if ($_SESSION['user'] != NULL) { ?>
		<a href="../admin/updateUserInfo.php">Settings</a>
	<?php } ?>
	<?php if ($_SESSION['user'] != NULL) { ?>
		<a href="../user/logout.php">Log out</a>
	<?php } else { ?>
		<a href="login_page.php">Log in</a>
  <?php } ?>
  <?php if ($_SESSION['user'] == NULL) { ?>
    <a href="/user/signup.php">Sign up</a>
  <?php } ?>
	
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>

</body>
</html>