<?php
session_start();
include '../config/dbConnectionNew.php';

$userId = $_SESSION['user']['user_id'];
$id = $_GET['imageid'];

include '../controller/like_unlike.php';
include '../controller/comment.php';
$results = $con->prepare("SELECT * FROM images WHERE `id`=$id");
$results->execute();
$images = $results->fetchAll();

$likes = $con->prepare("SELECT * FROM likes WHERE `image_id`=$id AND `user_id`=$userId");
$likes->execute();
$row = $likes->fetch();

$com_query = $con->prepare("SELECT users.name AS name, tbl_comment.comment FROM `users` JOIN tbl_comment on tbl_comment.user_id = users.user_id WHERE tbl_comment.image_id =?");
$com_query->execute([$id]);
$Allcomments = $com_query->fetchAll();
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
			img{
				max-width: 100%;
				max-height: 100%;
			}
		</style>
	</head>
	<body>
		<?php include '../user/header.php';?>
			<div class="row text-center">
				<div class="col">
					<form method="POST" action="">
						<?php foreach($images as $image) { ?>
							<img style="margin: 1vw" src="<?php echo '../img/'.$image['image']?>">
						<?php $tot_like = $image['like_count']; } ?><br>
						<?php if (!$row){ ?>
							<div style="margin:1vw">
								<input type="submit" name="submit" class="btn btn-primary btn-md" value="Like">
								<?php echo $tot_like. '<b> likes</b>'; ?>
							</div>
						<?php } else { ?>
							<div style="margin:1vw">
								<input type="submit" name="submit" class="btn btn-info btn-md" value="Unlike">
								<?php echo $tot_like. '<b> likes</b>'; ?>
							</div>
						<?php } ?>
						<div>
							<div>
								<textarea rows="3" cols="50" placeholder='Enter comment' name='comm'></textarea>
							</div>
							<!-- <input class='comform' type='text' placeholder='Enter comment' name='comm'> -->
							<div><input type='submit' class='submit' name='submit' value='Comment'/></div>
						</div>
					</form>
					<div class="row text-center justify-content-center" style="margin:1vw">
						<div class="col-md-4 col-xs-12 text-center"></div>
						<div class="col-md-4 col-xs-12 text-center">
								<?php
								if ($Allcomments)
								{
									echo '<table class="table table-striped">';
									foreach($Allcomments as $comt)
									{
										echo '<tr>';
										echo '<td style="text-align: left;">'.'<a href="">'.$comt['name'].'</a>'.'</td>';
										echo '<td style="text-align: left">'.htmlentities($comt['comment']).'</td>';
										echo  '<tr>';
									}
									echo '</table>';
								}
								?>
						</div>
						<div class="col-md-4 col-xs-12 text-center"></div>
					</div>
				</div>
				<?php include '../footer.php'; ?>
			</div>
	</body>
</html>