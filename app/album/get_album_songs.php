<?php
require_once "../../classes/Music.php";
$music = new Music();

if (!isset($_GET['album_id'])) {
  http_response_code(400);
  echo json_encode(["error" => "album_id required"]);
  exit;
}

$albumId = intval($_GET['album_id']);
$songs = $music->getSongsByAlbumsForAbums($albumId);
$album = $music->getAlbumById($albumId);
$team = $music->getAlbumTeam($albumId); 

exit(json_encode([
  "album" => $album,
  "songs" => $songs,
  "team"  => $team    
]));
?>
