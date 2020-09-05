<?php
session_start();
include '../config/dbConnectionNew.php';
date_default_timezone_set('Europe/Helsinki');

if ($_SESSION != NULL)
{
$next = 0;
$prev = 0;
$images_per_page = 5;

$results = $con->prepare("SELECT * FROM images");
$results->execute();
$number_of_images = $results->rowCount(); 
$page = 1;

$number_of_pages = ceil($number_of_images / $images_per_page);

if (isset($_GET['page']))
{
	$page = intval($_GET['page']);
	$next = $page + 1;
	$prev = $page - 1;

	if ($page > $number_of_pages && $next > $number_of_pages){
		$page = $number_of_pages;
		$next = $page;
	}
	elseif($page < 1){
		$page = 1;
	}
}else{
	$page = 1;
}
$start_limit = ($page - 1) * $images_per_page;

// $results = $con->prepare("SELECT * FROM images ORDER BY id DESC LIMIT " . $start_limit . ',' . $images_per_page);
// $results->execute();
// $images = $results->fetchAll();

$results = $con->prepare("SELECT users.username, images.image, images.id FROM users JOIN images ON images.user_id = users.user_id ORDER BY id DESC LIMIT " . $start_limit . ',' . $images_per_page);
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
		.column {
			float: left;
			width: 33.33%;
			padding: 5px;
		}

		/* Clear floats after image containers */
		.row::after {
			content: "";
			clear: both;
			display: table;
		}

		.pagination {
			display: inline-flex;
			padding-left: 0;
			/* margin: 20px 0; */
			border-radius: 4px;

		}

		.pagination a {
			background: rgba(0, 0, 0, 0.4);
			margin-left: 50%;
			color: black;
			float: left;
			padding: 8px 16px;
			text-decoration: none;
			transition: background-color .3s;
			border: 1px solid #ddd;
		}

		.pagination a.active {
			background-color: #4CAF50;
			color: white;
			border: 1px solid #4CAF50;
		}

		.pagination a:hover:not(.active) {
			background-color: #ddd;
		}
		img {
			max-width: 100%;
			max-height: 100%;
		}
	</style>
</head>

<body>
	<?php include '../user/header.php';?>
			<div class="row" style="margin: .5vw">
				<?php foreach($images as $image){ ?>
					<div class="col-lg-3 col-xs-10 col-md-4">
						<div class="feed-header">
							<p>Photo by: <a href=""><?php echo $image['username'];?></a></p>
						</div>
						<div>
							<?php if ($_SESSION['user'] != NULL) { ?>
								<a href="../controller/likes.php?imageid=<?php echo $image['id'];?>"><img src="<?php echo '../img/'. $image['image']; ?>" margin="auto" /></a></br>
							<?php } else { ?> 
								<img src="<?php echo '../img/'. $image['image']; ?>" margin="auto" />
							<?php } ?> 
						</div>
					</div>
				<?php } ?>	
			</div>
			<div class="row">
				<div class="col" style="margin-left: 45%;">
						<?php
							if ($page < $number_of_pages && $page > 1) {
								echo '<div class="pagination">
									<a style="color: #14FFFF;" href="gallery.php?page=' . $prev . '">' .  '❮' . '</a>';
								echo '<a style="color: #14FFFF;" href="gallery.php?page=' . $next . '">' .  '❯' . '</a>
								</div>  ';
							} elseif ($page == $number_of_pages && $page > 1) {
								echo	'<div class="pagination">
									<a style="color: #14FFFF;" href="gallery.php?page=' . $prev . '">' .  '❮' . '</a>';
							}
							if ($page == 1 && $number_of_pages != 1) {
								$next = $page + 1;
								echo	'<div class="pagination">
									<a style="color: #14FFFF;" href="gallery.php?page=' . $next . '">' .  '❯' . '</a> 
								</div>';
							}
						?>
				</div>
			</div>
			<?php include '../footer.php'; ?>
		</div>
</body>
</html>
<?php } else
header('Location: ../index.php')
?>