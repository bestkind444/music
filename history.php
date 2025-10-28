<!-- <ul class="row">
<?php
include_once "../classes/Music.php";

$music = new Music();
$songs = $music->getSongs();
?>


<?php while ($song = current($songs)) { ?>
    <li class="col-md-12">
        <figure>
            <img src="<?= $song['artworkPath'] ?>" alt="<?= htmlspecialchars($song['title']) ?>">
        </figure>
        <div class="wm-event-text">
            <div class="wm-event-info">
                <h2><?= htmlspecialchars($song['title']) ?></h2>
                <p>Artist: <?= htmlspecialchars($song['artistName']) ?></p>
                <p>Genre: <?= htmlspecialchars($song['genreName']) ?></p>
                <p>Duration: <?= htmlspecialchars($song['duration']) ?></p>
            </div>
            <div class="wm-event-link">
                <a href="<?= $song['path'] ?>" download>Download</a>
                <a href="#" onclick="playSong('<?= $song['path'] ?>')">Play</a>
            </div>
        </div>
    </li>
<?php next($songs); } ?>
</ul>

<script>
function playSong(path) {
    const audio = new Audio(path);
    audio.play();
}
</script> -->


