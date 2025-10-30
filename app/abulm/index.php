<?php
include_once "../../classes/Music.php";
$music = new Music();

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$data = $music->getAllAlbum($page);
$albums = $data['albums'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title> Trendingvibezz Album</title>

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
	<link href="../../dist/css/lightbox.css" rel="stylesheet" />

	<style>
		.song-item.active {
			background: #222;
			color: #fff;
			transition: all 1s ease;
		}

		body {
			filter: none !important;
			opacity: 1 !important;
		}
	</style>
</head>

<body>

	<!--// Main Wrapper \\-->
	<div class="wm-main-wrapper">
		<div class="muscibeat-loading-section">
			<div class="line-scale-pulse-out">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>

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
							<h1>Album</h1>
							<p>Check out our latest album</p>
						</div>
						<div class="clearfix"></div>
						<ul class="wm-breadcrumb">
							<li><a href="../">Home</a></li>
							<li>Album</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!--// Mini HEader \\-->
		<style>
			figure img {
				filter: none !important;
				transform: none !important;
				opacity: 1 !important;
				max-height: 300px;
			}

			.album-item {
				text-align: center;
			}
		</style>
		<!--// Main Content \\-->
		<div class="wm-main-content">

			<!--// Main Section \\-->
			<div class="wm-main-section wm-albumsingle-full">
				<div class="container">
					<div class="row">
						<aside class="col-md-3">
							<div class="widget widget_add">
								<a href="#"><img alt="" src="../asset/extra-images/widget-add-3.jpg"></a>
							</div>
							<div class="widget widget_artists">
								<div class="wm-widget-heading">
									<h2>Albums:</h2>
								</div>
								<ul>
									<?php foreach ($albums as $album): ?>
										<li class="album-item" data-album-id="<?= htmlspecialchars($album['id']) ?>">


											<figure>
												<a href="javascript:void(0)">
													<img data-album-id="<?= htmlspecialchars($album['id']) ?>" src="<?= htmlspecialchars('../../' . $album['artworkPath']) ?>" alt="">
												</a>
											</figure>
											<section class="">
												<h3><?= htmlspecialchars($album['title']) ?> – <?= htmlspecialchars($album['artistName']) ?></h3>
												<h4><?= htmlspecialchars($album['genreName']) ?></h4>
												<div class="clearfix"></div>
											</section>
										</li>
									<?php endforeach; ?>




									<ul class="wm-pagination">
										<?php if ($page > 1): ?>
											<li><a href="?page=<?= $page - 1 ?>"><i class="flaticon-arrows"></i></a></li>
										<?php endif; ?>

										<?php for ($i = 1; $i <= $data['pages']; $i++): ?>
											<li class="<?= $i == $page ? 'active' : '' ?>">
												<a href="?page=<?= $i ?>"><?= $i ?></a>
											</li>
										<?php endfor; ?>

										<?php if ($page < $data['pages']): ?>
											<li><a href="?page=<?= $page + 1 ?>"><i class="flaticon-arrows"></i></a></li>
										<?php endif; ?>
									</ul>

								</ul>
							</div>


						</aside>


						<div class="col-md-9">
							<style>
								figure img:hover {
									opacity: 1 !important;
									filter: none !important;

								}

								img {
									opacity: 1 !important;
									filter: none !important;

								}
							</style>
							<!--// Album List \\-->
							<div class="wm-album wm-album-medium">
								<ul class="row">
									<li class="col-md-12">
										<div class="wm-album-medium-wrap">
											<figure><a href="album-single-post.html" class="graythumb"><img src="../asset/extra-images/album-single-thumb-1.jpg" alt=""></a></figure>
											<div class="wm-album-medium-text">
												<h2><a href="album-single-post.html#">Everything Will Be OK</a></h2>
												<div class="wm-album-social-icon">
													<a href="https://www.facebook.com/" class="flaticon-social-1"></a>
													<a href="https://mobile.twitter.com/" class="flaticon-social-2"></a>
													<a href="http://musicbeats.net/" class="flaticon-shape"></a>
													<a href="https://www.spotify.com/int/why-not-available/" class="flaticon-social-3"></a>
												</div>
												<ul class="wm-album-options">
													<li><span class="wm-bgcolor wm-album-track-count"></span></li>
													<li><span>Release Date:</span> 07/03/2016</li>
													<li><span>Genre:</span> Remix Album</li>
												</ul>
												<p>Words by Heath Clayton, Photos by Paul Citone No better way to wrap up a great Phil and Friends two night run, than a brunch.</p>
												<div class="clearfix"></div>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<!--// Album List \\-->
							<style>
								#current-track5 {
									display: block;
									margin-top: 8px;
									font-size: 15px;
									color: #fff;
									text-align: center;
									white-space: nowrap;
									overflow: hidden;
									text-overflow: ellipsis;
								}

								.jp-controls {
									display: flex;
									align-items: center;
									justify-content: center;
									gap: 16px;
									/* space between buttons */
								}

								.jp-play {
									cursor: pointer;
									border: none;
									background: transparent;
									color: #fff;
									font-size: 30px;
								}

								.jp-play i {
									pointer-events: all;
								}
							</style>
							<!--// Album Player \\-->
							<div class="wm-albumplayer">
								<div id="jp_container_5" class="jp-audio" role="application" aria-label="media player">
									<div class="jp-type-playlist">


										<div id="jquery_jplayer_5" class="jp-jplayer"></div>
										<div class="jp-gui jp-interface">
											<div id="current-track5" class="song-title"></div>
											<div class="jp-controls">
												<span class="jp-shuffle"><i class="flaticon-arrows-2"></i></span>
												<span style="font-size: 30px; padding: 14px;" class="jp-play" type="button">
													<i class="fa fa-play"></i>
													<i class="fa fa-pause" style="display:none"></i>
												</span>
												<span class="jp-previous"><i class="flaticon-arrows-1"></i></span>
												<span class="jp-next"><i class="flaticon-arrows-1"></i></span>
												<span class="jp-repeat"><i class="flaticon-arrows-3"></i></span>
											</div>
											<div class="jp-volume-controls">
												<span class="jp-mute"><i class="fa fa-volume-up"></i> <i class="fa fa-volume-off"></i></span>
												<div class="jp-volume-bar">
													<div class="jp-volume-bar-value"></div>
												</div>
											</div>
											<div class="wm-player-wrap">
												<span class="jp-previous"><i class="flaticon-arrows-1"></i></span>
												<div class="jp-progress">
													<div class="jp-seek-bar">
														<div class="jp-play-bar"></div>
													</div>
												</div>
												<span class="jp-next"><i class="flaticon-arrows-1"></i></span>
												<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
											</div>
										</div>
										<div class="jp-playlist">
											<ul>
												<li>&nbsp;</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!--// Album Player \\-->

							<!--// Editore \\-->
							<div class="wm-editore">
								<div class="wm-blog-heading">
									<h2>Album Description</h2>
								</div>
								<p>A soulful blend of nostalgia and community spirit, this album captures the warmth and energy of a perfect Sunday with Phil and Friends and The Terrapin Family Band. Recorded live at the Brooklyn Bowl in Las Vegas, it celebrates family, friendship, and timeless music. Each track echoes the joy of shared moments, great food, and legendary performances — a true reflection of togetherness and musical harmony.</p>
							</div>
							<!--// Editore \\-->

							<div class="wm-albumteam-wrap">
								<div class="wm-blog-heading">
									<h2>Album Team</h2>
								</div>

								<div class="wm-artist-grid wm-albumteam-slider">
									<div class="wm-artist-slider-layer">
										<figure><a href=""><img src="../asset/extra-images/artist-grid-1.jpg" alt=""></a>
											<figcaption><a href=""><i class="flaticon-link"></i></a></figcaption>
										</figure>
										<div class="wm-artist-title">
											<h2><a href="">Jessica Dana Young</a></h2>
											<span>Backing vocalist</span>
										</div>
									</div>
									<div class="wm-artist-slider-layer">
										<figure><a href=""><img src="../asset/extra-images/artist-grid-2.jpg" alt=""></a>
											<figcaption><a href=""><i class="flaticon-link"></i></a></figcaption>
										</figure>
										<div class="wm-artist-title">
											<h2><a href="">Briennne Carla Johnson</a></h2>
											<span>Lead singer</span>
										</div>
									</div>
									<div class="wm-artist-slider-layer">
										<figure><a href=""><img src="../asset/extra-images/artist-grid-3.jpg" alt=""></a>
											<figcaption><a href=""><i class="flaticon-link"></i></a></figcaption>
										</figure>
										<div class="wm-artist-title">
											<h2><a href="">Cliffany Jana Williams</a></h2>
											<span>Bassist</span>
										</div>
									</div>
									<div class="wm-artist-slider-layer">
										<figure><a href=""><img src="../asset/extra-images/artist-grid-4.jpg" alt=""></a>
											<figcaption><a href=""><i class="flaticon-link"></i></a></figcaption>
										</figure>
										<div class="wm-artist-title">
											<h2><a href="">Cliffany Jana Williams</a></h2>
											<span>Bassist</span>
										</div>
									</div>
									<div class="wm-artist-slider-layer">
										<figure><a href=""><img src="../asset/extra-images/artist-grid-4.jpg" alt=""></a>
											<figcaption><a href=""><i class="flaticon-link"></i></a></figcaption>
										</figure>
										<div class="wm-artist-title">
											<h2><a href="">Jenny James Young</a></h2>
											<span>Rhythm guitarist</span>
										</div>
									</div>
								</div>
							</div>

							<!-- <style>
								.wm-artist-grid.wm-albumteam-slider {
									display: grid !important;
									grid-template-columns: repeat(3, 1fr) !important;
									gap: 1.5rem !important;
									/* space between items */
								}

								@media (max-width: 768px) {
									.wm-artist-grid.wm-albumteam-slider {
										grid-template-columns: repeat(1, 1fr);
									}
								}
							</style> -->

						</div>

					</div>
				</div>
			</div>


		</div>
		<!--// Main Content \\-->

		<!--// Footer \\-->
		<footer id="wm-footer" class="footer-two">

			<!--// Footer Bottom Section \\-->
			<?php include_once "../include/footer.php" ?>
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
							<a href="album-single-post.html#" class="wm-playlist-btn"><i class="flaticon-music-1"></i></a>
						</div>
					</div>
				</div>

			</div>



			<!-- <div class="wm-footer-player pb-md-8">
        <div id="jquery_jplayer_2" class="jp-jplayer"></div>
        <div
          id="jp_container_2"
          class="jp-audio"
          role="application"
          aria-label="media player">
          <span class="jp-stop wm-bgcolor"><i class="flaticon-power"></i></span>
          <div class="jp-type-playlist">
            <div class="jp-playlist">
              <ul>
                <li>&nbsp;</li>
              </ul>
            </div>
            <div class="jp-gui jp-interface">
              <div id="current-track1" class="song-title">

              </div>
              <div class="jp-controls">
                
                <span class="wm-bgcolor-one jp-previous"><i class="flaticon-arrows-1"></i></span>
                <span class="jp-play"><i class="fa fa-pause"></i> <i class="fa fa-play"></i></span>
                <span class="wm-bgcolor-one jp-next"><i class="flaticon-arrows-1"></i></span>
              
              </div>
              <div class="wm-player-wrap">
                <div class="jp-progress">
                  <div class="jp-seek-bar">
                    <div class="jp-play-bar"></div>
                  </div>
                </div>
                <div class="jp-volume-controls">
                  <span class="jp-mute"><i class="fa fa-volume-up"></i>
                    <i class="fa fa-volume-off"></i></span>
                  <div class="jp-volume-bar">
                    <div class="jp-volume-bar-value"></div>
                  </div>
                </div>
              </div>
              <a href="index-two.html#" class="wm-playlist-btn"><i class="flaticon-music-1"></i></a>
            </div>
          </div>
        </div>
      </div> -->

		</footer>
		<!--// Footer \\-->

		<div class="clearfix"></div>
	</div>

	<style>
		/* Footer player base */
		.wm-footer-player {
			position: fixed;
			bottom: -120px;
			/* hidden by default */
			left: 0;
			right: 0;
			z-index: 9999;
			background: #111;
			color: #fff;
			box-shadow: 0 -6px 20px rgba(0, 0, 0, 0.6);
			transition: bottom 300ms ease, opacity 300ms ease;
			opacity: 0;
			font-family: inherit;
			pointer-events: none;
			/* when hidden */
		}

		/* When active show and allow pointer events */
		.wm-footer-player.active {
			bottom: 0;
			opacity: 1;
			pointer-events: auto;
		}

		/* internal layout */
		.wm-footer-player-inner {
			display: flex;
			align-items: center;
			gap: 20px;
			padding: 10px 16px;
		}

		/* left, center, right columns */
		.fp-left {
			display: flex;
			align-items: center;
			gap: 12px;
			min-width: 220px;
		}

		.fp-center {
			display: flex;
			align-items: center;
			gap: 14px;
			flex: 1;
			justify-content: center;
		}

		.fp-right {
			display: flex;
			align-items: center;
			gap: 10px;
		}

		/* play button */
		.jp-play {
			cursor: pointer;
			border: none;
			background: transparent;
			color: #fff;
			font-size: 20px;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 6px;
		}

		/* ensure icons inside the button don't eat pointer events */
		.jp-play i {
			pointer-events: none;
		}

		/* track title - prevents overlapping with icons */
		.fp-track-title {
			font-size: 14px;
			max-width: 240px;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}

		/* progress bar */
		.fp-progress {
			width: 420px;
			max-width: 50%;
		}

		.jp-seek-bar {
			width: 100%;
			height: 8px;
			background: #333;
			border-radius: 4px;
			cursor: pointer;
			overflow: hidden;
		}

		.jp-play-bar {
			width: 0%;
			height: 100%;
			background: #ff0048;
			transition: width 120ms linear;
		}

		/* volume */
		.fp-vol {
			width: 90px;
			height: 8px;
			background: #333;
			border-radius: 4px;
			cursor: pointer;
		}

		.jp-volume-bar-value {
			width: 70%;
			height: 100%;
			background: #fff;
			transition: width 120ms linear;
		}

		/* small buttons */
		.fp-btn {
			cursor: pointer;
			border: none;
			background: transparent;
			color: #fff;
			font-size: 16px;
		}

		/* highlighted song-row in sidebar */
		.song-item.active {
			background: #222;
			color: #fff;
			transition: all 200ms ease;
		}
	</style>

	<script src="./au.js"></script>


	<!-- <script src="../playsong.js"></script> -->

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
	<!-- <script type="text/javascript" src="../asset/script/jquery.jplayer.js"></script> -->
	<!-- <script type="text/javascript" src="../asset/script/jplayer.playlist.js"></script> -->
	<script type="text/javascript" src="../asset/script/jquery.nicescroll.min.js"></script>
	<script type="text/javascript" src="../asset/script/moment.min.js"></script>
	<script type="text/javascript" src="../asset/script/fullcalendar.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="../asset/script/waypoints-min.js"></script>
	<script type="text/javascript" src="../asset/script/isotope.min.js"></script>
	<script type="text/javascript" src="../asset/script/functions.js"></script>
	<!-- <script type="text/javascript" src="../asset/script/jplayer.functions.js"></script> -->

	<script src="../../dist/js/lightbox.js"></script>

</body>

</html>