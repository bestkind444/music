<?php
include_once "../../../classes/DBConnection.php";
include_once "../../../classes/Music.php";
header("Content-Type: application/json");
$db = new DBConnection();
$conn = $db->conn;
$songs = new Music();

if (!isset($_GET['delete_id']) || !is_numeric($_GET['delete_id'])) {
    http_response_code(400);
    exit(["status" => "error", "message" => "invalid id"]);
}

$songs->deleteGenreByid($_GET['delete_id']);