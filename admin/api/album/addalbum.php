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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $genre = $_POST['genre'];

    // Upload album artwork
    $uploadDir = "../../../assets/images/artwork/";
    $fileName = basename($_FILES["album"]["name"]);
    $targetFile = $uploadDir . $fileName;
    $dbtarget = "assets/images/artwork/" . $fileName;

    if (move_uploaded_file($_FILES["album"]["tmp_name"], $targetFile)) {
        // Insert album and get the inserted album_id
        $stmt = $conn->prepare("INSERT INTO albums (title, artist, genre, artworkPath) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siis", $title, $artist, $genre, $dbtarget);
        $stmt->execute();
        $album_id = $stmt->insert_id; // new album ID
        $stmt->close();

        // Handle multiple team members
        if (!empty($_POST['member_name']) && !empty($_FILES['member_image']['name'][0])) {
            $memberNames = $_POST['member_name'];
            $memberImages = $_FILES['member_image'];

            $teamDir = "../../../assets/images/album_team/";

            foreach ($memberNames as $index => $name) {
                if (!empty($memberImages['name'][$index])) {
                    $imgName =  basename($memberImages['name'][$index]);
                    $targetImg = $teamDir . $imgName;
                    $dbImg = "assets/images/album_team/" . $imgName;

                    if (move_uploaded_file($memberImages['tmp_name'][$index], $targetImg)) {
                        $stmt2 = $conn->prepare("INSERT INTO album_team (album_id, member_name, member_image) VALUES (?, ?, ?)");
                        $stmt2->bind_param("iss", $album_id, $name, $dbImg);
                        $stmt2->execute();
                        $stmt2->close();
                    }
                }
            }
        }

        http_response_code(200);
        echo json_encode(["status" => "success", "message" => "Album and team uploaded successfully"]);
    } else {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Failed to upload album artwork"]);
    }
}
?>
