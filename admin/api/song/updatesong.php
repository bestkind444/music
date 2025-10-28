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

  $query = $conn->query("");

 
}






}


$query = $con->prepare("UPDATE `album`
                        SET `total_duration` = ?
                        WHERE `album_id` = ?");
$query->bind_param("ii", $current_duration, $album_id);
if(!$query->execute()) {
  $result = ["status" => "error", "description" => "unable to update song"];
  http_response_code(500);
  exit(json_encode($result));
}

// update song to db
$mainquery = $con->prepare('UPDATE `song` 
                            SET `album_id` = ?, `audio_path` = ?, `duration` = ?, `genre` = ?, `image_path` = ?, `judul` = ?, `tanggal_terbit` = ?
                            WHERE `song_id` = ?');
$mainquery->bind_param('isissssi', $album_id, $audio_path, $duration, $genre, $image_path, $judul, $tanggal_terbit, $_POST['song_id']);

if (!$mainquery->execute()) { 
    $result = ["status" => "error", "description" => $con->error];
    http_response_code(500);
    exit(json_encode($result));
}

$result = ["status" => "success", "description" => "song successfully changed"];
http_response_code(200);

echo json_encode($result);

?>