<?php
// if (class_exists("DBConnection") && class_exists("Music")) {

// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Trendingvibezz Artist</title>

	<!-- Css Files -->
	<link href="../asset/css/bootstrap.css" rel="stylesheet">
	<link href="../asset/css/font-awesome.css" rel="stylesheet">
	<link href="../asset/css/flaticon.css" rel="stylesheet">
	<link href="../style.css" rel="stylesheet">
	<link href="../asset/css/color.css" rel="stylesheet">
	<link href="../asset/css/color-one.css" rel="stylesheet">
	<link href="../asset/css/color-two.css" rel="stylesheet">
	<link href="../asset/css/slick-slider.css" rel="stylesheet">
	<link href="../asset/css/prettyphoto.css" rel="stylesheet">
	<link href="../asset/css/jplayer.css" rel="stylesheet">
	<link href="../asset/css/responsive.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

	<!--// Main Wrapper \\-->
	<!-- <div class="wm-main-wrapper">
		<div class="muscibeat-loading-section">
			<div class="line-scale-pulse-out">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div> -->

	<!--// Header \\-->
	<?php include "../include/header.php" ?>
	<!--// Header \\-->

	<!--// Mini HEader \\-->
	<div class="wm-mini-header">
		<span class="wm-black-transparent"></span>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="wm-page-heading">
						<h1>Artist List</h1>
						<p>Check out our Latest Artist</p>
					</div>
					<div class="clearfix"></div>
					<ul class="wm-breadcrumb">
						<li><a href="../">Home</a></li>
						<li>Artist List</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--// Mini HEader \\-->

	<!--// Main Content \\-->
	<div class="wm-main-content">
		<style>
			.wm-artist-text figure img {
				width: 100%;
				height: auto;
				max-height: 200px;
				/* object-fit: cover; */
				/* display: block; */
			}

			/* Prevent image overflow */
			figure {
				overflow: hidden;
				border-radius: 6px;
			}

			figure img {
				filter: none !important;
				transform: none !important;
				opacity: 1 !important;
				max-height: 300px;
			}
		</style>
		<!--// Main Section \\-->
		<div class="wm-main-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="wm-artist wm-artist-medium">
							<ul class="row">
								<?php
								include_once "../../classes/DBConnection.php";
								include_once "../../classes/Music.php";
								$music = new Music();

								$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
								$data = $music->getAllArtists($page);
								$artists = $data['artists'];
								$totalPages = $data['totalPages'];
								$currentPage = $data['currentPage'];

								?>

								<?php foreach ($artists as $artist):   ?>

									<li class="col-md-12">
										<figure>
											<a href="../single_artiste/?single=<?= htmlspecialchars($artist['id'])?>">
												<img src="<?= htmlspecialchars('../../' . $artist['artiste_profile']) ?>" alt="">
											</a>
										</figure>

										<div class="wm-artist-text">
											<div class="wm-artist-title">
												<div class="wm-title">
													<h2><a href="../single_artiste/?single<?= htmlspecialchars($artist['id'])?>"><?= htmlspecialchars($artist['name']) ?></a></h2>
													<!-- <span>Rhythm guitarist</span> -->
												</div>

												<ul>
													<li><a href=""><span class="flaticon-social-1"></span></a></li>
													<li><a href=""><span class="flaticon-social-2"></span></a></li>
													<li><a href=""><span class="flaticon-shape"></span></a></li>
													<li><a href=""><span class="flaticon-social-3"></span></a></li>
												</ul>
											</div>

											<p><?= htmlspecialchars($artist['bio']) ?></p>
										</div>
									</li>

								<?php endforeach; ?>
							</ul>
						</div>
						<div class="wm-pagination-wrap">
							<ul class="wm-pagination">

								<!-- Prev button -->
								<?php if ($currentPage > 1): ?>
									<li><a href="?page=<?= $currentPage - 1 ?>"><i class="flaticon-arrows"></i></a></li>
								<?php endif; ?>

								<!-- Numbered pages -->
								<?php for ($i = 1; $i <= $totalPages; $i++): ?>
									<li class="<?= $i == $currentPage ? 'active' : '' ?>">
										<a href="?page=<?= $i ?>"><?= $i ?></a>
									</li>
								<?php endfor; ?>

								<!-- Next button -->
								<?php if ($currentPage < $totalPages): ?>
									<li><a href="?page=<?= $currentPage + 1 ?>"><i class="flaticon-arrows"></i></a></li>
								<?php endif; ?>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--// Main Section \\-->

	</div>
	<!--// Main Content \\-->

	<!--// Footer \\-->
	<footer id="wm-footer" class="footer-two">

		<!--// Footer Widget \\-->
		<!--// Footer Widget \\-->

		<!--// Footer Bottom Section \\-->
		<?php  include_once "../include/footer.php" ?>
		<!--// Footer Bottom Section \\-->

		<!--// Player \\-->
		
		<!--// Player \\-->

	</footer>
	<!--// Footer \\-->

	</div>
	<!--// Main Wrapper \\-->

	<!-- jQuery (necessary for JavaScript plugins) -->
	<script type="text/javascript" src="../asset/script/jquery.js"></script>
	<script type="text/javascript" src="../asset/script/modernizr.js"></script>
	<script type="text/javascript" src="../asset/script/jquery-ui.js"></script>
	<script type="text/javascript" src="../asset/script/bootstrap.min.js"></script>
	<script type="text/javascript" src="../asset/script/jquery.prettyphoto.js"></script>
	<script type="text/javascript" src="../asset/script/jquery.countdown.min.js"></script>
	<script type="text/javascript" src="../asset/script/fitvideo.js"></script>
	<script type="text/javascript" src="../asset/script/skills.js"></script>
	<script type="text/javascript" src="../asset/script/slick.slider.min.js"></script>
	<script type="text/javascript" src="../asset/script/jquery.jplayer.js"></script>
	<script type="text/javascript" src="../asset/script/jplayer.playlist.js"></script>
	<script type="text/javascript" src="../asset/script/jquery.nicescroll.min.js"></script>
	<script type="text/javascript" src="../asset/script/moment.min.js"></script>
	<script type="text/javascript" src="../asset/script/fullcalendar.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="../asset/script/waypoints-min.js"></script>
	<script type="text/javascript" src="../asset/script/isotope.min.js"></script>
	<script type="text/javascript" src="../asset/script/functions.js"></script>
	<script type="text/javascript" src="../asset/script/jplayer.functions.js"></script>
</body>

</html>