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
  $genre = $_POST['name'];
  if (!$genre) {
    http_response_code(400);
    exit(["status" => "error", "message" => "empty input"]);
  }

$songs->uploadGenre($genre);
  
}