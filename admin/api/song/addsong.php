<?php

include_once "../../../classes/DBConnection.php";
include_once "../../../classes/Music.php";

$db = new DBConnection();
$conn = $db->conn;
$songs = new Music();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $album = $_POST['album'];
    $genre = $_POST['genre'];
    $identity = $_POST['identity'];

    $uploadDir = "../../../assets/music/";
    $fileName = basename($_FILES["song"]["name"]);
    $targetFile = $uploadDir . $fileName;
     $dbtarget = "assets/music/" . $fileName;
    // Validate and upload
    if (move_uploaded_file($_FILES["song"]["tmp_name"], $targetFile)) {
        $songs->insertSong($title, $artist, $album, $genre, $dbtarget, $identity);
    } else {
        http_response_code(400);
        exit(["status" => "error", "message" => "failed to upload file"]);
    }
}




?>