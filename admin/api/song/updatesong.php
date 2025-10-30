<?php

include_once "../../../classes/DBConnection.php";
// include_once "../../../classes/Music.php";

$db = new DBConnection();
$conn = $db->conn;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $title = $_POST['title'];
  $duration = $_POST['duration'];
  $created_at = $_POST['created_at'];
  $song_identifier = $_POST['song_identifier'];
  $id = $_POST['id'];

  if (!empty($title) && !empty($duration) && !empty($created_at) && !empty($song_identifier)) {
    $query = $conn->query("UPDATE songs 
        SET  title = '$title', 
            duration = '$duration', 
            created_at = '$created_at', 
            song_identifier = '$song_identifier' 
        WHERE id = $id
    ");

    if ($query) {
      http_response_code(200);
      exit(json_encode([
        "status" => "success",
        "message" => "Updated successfully"
      ]));
    } else {
      http_response_code(500);
      exit(json_encode([
        "status" => "error",
        "message" => "Failed to update song"
      ]));
    }
  }
}
