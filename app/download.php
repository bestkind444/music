<?php
include_once "../classes/Music.php";

if (!isset($_GET['id'])) {
    die("No song ID provided.");
}

$music = new Music();
$song = $music->getSongById($_GET['id']);

if (!$song) {
    die("Song not found.");
}

$file = "../" . $song['path'];

if (file_exists($file)) {
    // Optional: count download
    // $music->incrementDownloads($song['id']);

    header("Content-Description: File Transfer");
    header("Content-Type: audio/mpeg");
    header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
    header("Content-Length: " . filesize($file));
    readfile($file);
    exit;
} else {
    echo "File not found.";
}

