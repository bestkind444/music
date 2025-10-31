<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset( $_SESSION['admin_id'])) {
    header("location: ../../");
    exit;
}
include_once "../../../classes/DBConnection.php";
include_once "../../../classes/Music.php";

$db = new DBConnection();
$conn = $db->conn;
$songs = new Music();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $artist_name = $_POST['artistename'];
  $artist_bio = $_POST['bio'];
  if (!$artist_name ||   !$artist_bio) {
    http_response_code(400);
    exit(["status" => "error", "message" => "empty input"]);
  }
  $uploads = "../../../assets/images/artise/";
$dbtarget =  "assets/images/artise/"  . basename($_FILES['file']['name']);
  $destination = $uploads . basename($_FILES['file']['name']);
  if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
      $songs->uploadArtiste($artist_name, $dbtarget,  $artist_bio);
  }


  
}