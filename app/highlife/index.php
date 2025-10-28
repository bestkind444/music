<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Trendingvibezz</title>

	<!-- Css Files -->
	<link href="../asset/css/bootstrap.css" rel="stylesheet">
	<link href="../asset/css/font-awesome.css" rel="stylesheet">
	<link href="../asset/css/flaticon.css" rel="stylesheet">
	<link href="../style.css" rel="stylesheet">
	<link href="../asset/css/color.css" rel="stylesheet">
	<link href="../asset/css/color-one.css" rel="stylesheet">
	<link href="../asset/css/color-two.css" rel="stylesheet">
	<link href="../asset/css/color-three.css" rel="stylesheet">
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
						<h1>HighLife Music</h1>
						<p>Check out for HighLife Music</p>
					</div>
					<div class="clearfix"></div>
					<ul class="wm-breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li>HighLife Music</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	

		<!--// Main Section \\-->

		<!--// Main Section \\-->

		<!--// Main Section \\-->


		<style>
			li figure {
				width: 100%;
				margin: 0 auto;
				overflow: hidden;

			}

			li figure img {
				width: 100%;
				height: auto;
				margin-top: 10px;
				/* display: block; */
				/* object-fit: cover; */
				max-height: 200px;
				filter: none !important;
				transform: none !important;
				opacity: 1 !important;

			}

			@media(max-width: 992px) {
				li figure img {
					max-height: 300px;
				}

			}


			@media (max-width: 576px) {
				li figure img {
					max-height: 200px;
				}
			}
		</style>
		<!--// Main Section \\-->
		<div class="wm-main-section wm-event-list-full">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="wm-simple-facny-title wm-in-light">
							<h2>Musics Play and Download</h2>
						</div>
						<div class="wm-event wm-event-list">
							<ul class="row">
								<?php
								include_once "../../classes/Music.php";

								$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
								$music = new Music();
								$data = $music->getSongsByIdentifier('highlife', $page);

								$songs = $data['songs'];
								$totalPages = $data['pages'];
								$currentPage = $data['page'];
								?>


								<?php if (!empty($songs)) { ?>
									<?php while ($song = current($songs)) { ?>
										<li class="col-md-12 mb-10">
											<figure>
												<img src="<?= '../../' . $song['artworkPath'] ?>" alt="<?= htmlspecialchars($song['title']) ?>">
											</figure>
											<div class="wm-event-text">
												<div class="wm-event-info">
													<h2><?= htmlspecialchars($song['title']) ?></h2>
													<p>Artist: <?= htmlspecialchars($song['artistName']) ?></p>
													<p>Genre: <?= htmlspecialchars($song['genreName']) ?></p>
													<p>Duration: <?= htmlspecialchars($song['duration']) ?></p>
												</div>
												<div class="wm-event-link">
													<a href="../download.php?id=<?= $song['id'] ?>"><i class="bi bi-download"></i> Download</a>
													<a href="#"
														class="play-btn"
														data-path="<?= '../../' . $song['path'] ?>"
														data-title="<?= htmlspecialchars($song['title']) ?>"
														data-artist="<?= htmlspecialchars($song['artistName']) ?>">
														<i class="bi bi-play-circle"></i> Play</a>
												</div>
											</div>
										</li>

									<?php next($songs);
									} ?>
								<?php } else { ?>
									<p>No songs found.</p>
								<?php } ?>
							</ul>

							<!-- PAGINATION -->
							<div class="wm-pagination-wrap">
								<ul class="wm-pagination">
									<?php if ($currentPage > 1): ?>
										<li><a href="?page=<?= $currentPage - 1 ?>"><i class="flaticon-arrows-left"></i></a></li>
									<?php endif; ?>

									<?php for ($i = 1; $i <= $totalPages; $i++): ?>
										<li class="<?= $i == $currentPage ? 'active' : '' ?>">
											<a href="?page=<?= $i ?>"><?= $i ?></a>
										</li>
									<?php endfor; ?>

									<?php if ($currentPage < $totalPages): ?>
										<li><a href="?page=<?= $currentPage + 1 ?>"><i class="flaticon-arrows"></i></a></li>
									<?php endif; ?>
								</ul>
							</div>



						</div>

					</div>
				</div>
			</div>
		</div>

	</div>
	<!--// Main Content \\-->

	<!--// Footer \\-->
	<footer id="wm-footer" class="footer-two">


		<!--// Footer Bottom Section \\-->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="wm-footer-bottom-section">
						<div class="row">
							<div class="col-md-8">
								<div class="wm-newslatter-section">
									<div class="wm-footer-widget-title">
										<h2>subscribe to our newsletter:</h2>
									</div>
									<form>
										<input type="text" value="Your Email Address" onblur="if(this.value == '') { this.value ='Your Email Address'; }" onfocus="if(this.value =='Your Email Address') { this.value = ''; }">
										<input type="submit" value="Subscribe Now" class="wm-color wm-bordercolor">
									</form>
								</div>
							</div>
							<div class="col-md-4">
								<div class="wm-footer-social-media">
									<ul class="wm-footer-icons">
										<li><a href="https://mobile.twitter.com/"><i class="flaticon-social-2"></i> twitter</a></li>
										<li><a href="https://www.facebook.com/"><i class="flaticon-social-1"></i> facebook</a></li>
										<li><a href="https://www.spotify.com/int/why-not-available/"><i class="flaticon-social-3"></i> spotify</a></li>
										<li><a href="http://musicbeats.net/"><i class="flaticon-shape"></i> Musicbeat</a></li>
									</ul>
									<p>© 2016, All Right <a href="index.html">Reserved</a> - by <a href="index.html">WebMarce</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--// Footer Bottom Section \\-->

		<!--// Player \\-->
		<div class="wm-footer-player">

			<div id="jquery_jplayer_2" class="jp-jplayer"></div>
			<div id="jp_container_2" class="jp-audio" role="application" aria-label="media player">
				<div class="jp-type-playlist">
					<div class="jp-playlist">
						<ul>
							<li>&nbsp;</li>
						</ul>
					</div>
					<div class="jp-gui jp-interface">
						<span class="jp-stop wm-bgcolor"><i class="flaticon-power"></i></span>
						<div id="current-track1" class="song-title">Catch & Release</div>
						<div class="jp-controls">
							<span class="jp-shuffle"><i class="flaticon-arrows-2"></i></span>
							<span class="wm-bgcolor-one jp-previous"><i class="flaticon-arrows-1"></i></span>
							<span class="jp-play"><i class="fa fa-pause"></i> <i class="fa fa-play"></i></span>
							<span class="wm-bgcolor-one jp-next"><i class="flaticon-arrows-1"></i></span>
							<span class="jp-repeat"><i class="flaticon-arrows-3"></i></span>
						</div>
						<div class="wm-player-wrap">
							<div class="jp-progress">
								<div class="jp-seek-bar">
									<div class="jp-play-bar"></div>
								</div>
							</div>
							<div class="jp-volume-controls">
								<span class="jp-mute"><i class="fa fa-volume-up"></i> <i class="fa fa-volume-off"></i></span>
								<div class="jp-volume-bar">
									<div class="jp-volume-bar-value"></div>
								</div>
							</div>
						</div>
						<a href="event-list.html#" class="wm-playlist-btn"><i class="flaticon-music-1"></i></a>
					</div>
				</div>
			</div>

		
		<!--// Player \\-->
 <style>
        .wm-footer-player {
          position: fixed;
          bottom: 0;
          left: 0;
          right: 0;
          z-index: 9999;
          /* display: none; */
          background: #111;
          color: #fff;
          box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.4);
        }

        .wm-footer-player.active {
          display: block;
          /* show when active */
        }

        .jp-progress {
          /* width: 100px; */
          height: 6px;
          /* background: #333; */
          border-radius: 3px;
          overflow: hidden;
          cursor: pointer;
          margin-top: 10px;
        }

        .jp-seek-bar {
          width: 100%;
          height: 100%;
          background: #444;
          margin: 0 auto;

        }

        .jp-play-bar {
          width: 100%;
          height: 100%;
          background: #ff0048;
          transition: width 0.2s linear;

        }
      </style>
	</footer>
	<!--// Footer \\-->

	</div>
	<!--// Main Wrapper \\-->

	<!-- jQuery (necessary for JavaScript plugins) -->
	<script src="../asset/script/playsong.js"></script>
	<script type="text/javascript" src="../asset/script/jquery.js"></script>
	<script type="text/javascript" src="../asset/script/modernizr.js"></script>
	<script type="text/javascript" src="../asset/script/jquery-ui.js"></script>
	<script type="text/javascript" src="../asset/script/bootstrap.min.js"></script>
	<script type="text/javascript" src="../asset/script/jquery.prettyphoto.js"></script>
	<script type="text/javascript" src="../asset/script/jquery.countdown.min.js"></script>
	<script type="text/javascript" src="../asset/script/fitvideo.js"></script>
	<script type="text/javascript" src="../asset/script/skills.js"></script>
	<script type="text/javascript" src="../asset/script/slick.slider.min.js"></script>
	<!-- <script type="text/javascript" src="../asset/script/jquery.jplayer.js"></script> -->
	<!-- <script type="text/javascript" src="../asset/script/jplayer.playlist.js"></script> -->
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