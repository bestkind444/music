<?php
header("Content-Type: application/json");

require_once '../../../classes/Music.php';


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
   $result = ["status" => "error", "message" => "invalid id"];
  http_response_code(400);
  exit(json_encode($result));
}
$music = new Music();
$music->deleteMusicByid($_GET['id']);



?>