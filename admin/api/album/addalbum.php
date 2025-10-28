<?php

include_once "../../../classes/DBConnection.php";
include_once "../../../classes/Music.php";

$db = new DBConnection();
$conn = $db->conn;
$songs = new Music();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $genre = $_POST['genre'];

    $uploadDir = "../../../assets/images/artwork/";
    $fileName = basename($_FILES["album"]["name"]);
    $targetFile = $uploadDir . $fileName;
     $dbtarget = "assets/images/artwork/" . $fileName;
    // Validate and upload
    if (move_uploaded_file($_FILES["album"]["tmp_name"], $targetFile)) {
        $songs->uploadAlbum($title, $artist,  $genre, $dbtarget);
    } else {
        http_response_code(400);
        exit(["status" => "error", "message" => "failed to upload file"]);
    }
}




?>