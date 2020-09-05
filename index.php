<?php
session_start();
include 'config/setup.php';
include 'config/dbConnectionNew.php';
date_default_timezone_set('Europe/Helsinki');

// $results = $con->prepare("SELECT * FROM images ORDER BY id DESC");
// $results->execute();
// $images = $results->fetchAll();

$results = $con->prepare("SELECT users.username, images.image FROM users JOIN images ON images.user_id = users.user_id ORDER BY id DESC");
$results->execute();
$images = $results->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Gallery</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style>
		img {
			max-width: 100%;
			max-height: 100%;
		}
	</style>
</head>

<body>
	<?php include 'user/header.php'; ?>
			<div class="row" style="margin: 1vw;">
				<?php foreach($images as $image){ ?>
					<div class="col-lg-3 col-xs-6 col-md-3 text-center" >
						<div class="feed-header">
							<p>Photo by: <a href=""><?php echo $image['username'];?></a></p>
						</div>
						<div style="margin: .2vw">
							<?php if ($_SESSION['user'] != NULL) { ?>
								<a href="../controller/likes.php?imageid=<?php echo $image['id'];?>"><img class="img-responsive" src="<?php echo '../img/'. $image['image']; ?>" margin="auto" /></a></br>
							<?php } else { ?> 
								<img src="<?php echo 'img/'. $image['image']; ?>" margin="auto" />
							<?php } ?> 
						</div>
					</div>
				<?php } ?>	
			</div>
			<?php include 'footer.php'; ?>
		</div>
</body>

</html>