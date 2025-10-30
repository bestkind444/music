<?php
include_once "DBConnection.php";

class Music extends DBConnection
{

    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    // album artwork, artist name, and genre name
    public function getSongs($page = 1, $limit = 7)
    {
        $offset = ($page - 1) * $limit;

        // total number of songs for pagination
        $countSql = "SELECT COUNT(*) AS total FROM Songs";
        $countResult = $this->conn->query($countSql);
        $total = ($countResult && $countResult->num_rows > 0)
            ? $countResult->fetch_assoc()['total']
            : 0;

        // songs for the current page
        $sql = "SELECT 
                Songs.id, Songs.title, Songs.duration, Songs.path,  Songs.plays,
                albums.artworkPath,
                artists.name AS artistName,
                genres.name AS genreName
            FROM Songs
            JOIN albums ON Songs.album = albums.id
            JOIN artists ON Songs.artist = artists.id
            JOIN genres ON Songs.genre = genres.id
            ORDER BY Songs.id DESC
            LIMIT $offset, $limit";

        $result = $this->conn->query($sql);

        $songs = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $songs[] = $row;
            }
        }

        return [
            'songs' => $songs,
            'total' => $total,
            'limit' => $limit,
            'page' => $page,
            'pages' => ceil($total / $limit)
        ];
    }

    public function getSongsForAdmin()
    {
        $sql = "SELECT 
                Songs.id, Songs.title, Songs.duration, Songs.path,  Songs.plays,
                albums.artworkPath,
                artists.name AS artistName,
                genres.name AS genreName
            FROM Songs
            JOIN albums ON Songs.album = albums.id
            JOIN artists ON Songs.artist = artists.id
            JOIN genres ON Songs.genre = genres.id
            ORDER BY Songs.id DESC";

        $result = $this->conn->query($sql);

        $songs = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $songs[] = $row;
            }
        }

        return $songs;
    }



    //get music by id;
    public function getSongById($id)
    {
        $id = intval($id);

        $sql = "SELECT 
                Songs.id, Songs.title, Songs.duration, Songs.path, Songs.plays,
                albums.artworkPath,
                artists.name AS artistName,
                genres.name AS genreName
            FROM Songs
            JOIN albums ON Songs.album = albums.id
            JOIN artists ON Songs.artist = artists.id
            JOIN genres ON Songs.genre = genres.id
            WHERE Songs.id = $id 
            ";

        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    //get single artise song 
    public function getSingleArtiseSongById($id, $page = 1, $limit = 5)
    {
        $id = intval($id);
        $offset = ($page - 1) * $limit;

        //  count total songs for pagination
        $countSql = "SELECT COUNT(*) AS total 
                 FROM Songs 
                 WHERE artist = $id";
        $countResult = $this->conn->query($countSql);
        $total = ($countResult && $countResult->num_rows > 0)
            ? $countResult->fetch_assoc()['total']
            : 0;

        $sql = "SELECT 
                Songs.id, Songs.title, Songs.duration, Songs.path, Songs.plays,
                albums.artworkPath,
                artists.name AS artistName,
                genres.name AS genreName
            FROM Songs
            JOIN albums ON Songs.album = albums.id
            JOIN artists ON Songs.artist = artists.id
            JOIN genres ON Songs.genre = genres.id
            WHERE Songs.artist = $id
            ORDER BY Songs.id DESC
            LIMIT $offset, $limit";

        $result = $this->conn->query($sql);

        $songs = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $songs[] = $row;
            }
        }

        // both songs and pagination info
        return [
            'songs' => $songs,
            'total' => $total,
            'limit' => $limit,
            'page' => $page,
            'pages' => ceil($total / $limit)
        ];
    }


    //delet music
    public function deleteMusicByid($id)
    {
        $id = intval($id);
        $statement = $this->conn->prepare("DELETE FROM songs WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();

        if ($statement->affected_rows > 0) {
            $statement->close();
            http_response_code(200);
            exit(json_encode(["status" => "success", "message" => "Song deleted successfully"]));
        } else {
            http_response_code(500);
            exit(json_encode(["status" => "error", "message" => "Failed to delete song"]));
        }
    }

    //upload music
    public function insertSong($title, $artist, $album, $genre, $path, $song_identifier, $plays = 0)
    {
        require_once __DIR__ . '/../vendor/autoload.php';

        $getID3 = new getID3;
        $realPath = realpath("../../../" . $path);
        $fileInfo = $getID3->analyze($realPath);

        $formattedDuration = isset($fileInfo['playtime_string']) ? $fileInfo['playtime_string'] : "00:00";

        $sql = "INSERT INTO Songs (title, artist, album, genre, path, duration, song_identifier, plays)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("siissssi", $title, $artist, $album, $genre, $path, $formattedDuration, $song_identifier, $plays);

        if ($stmt->execute()) {
            $stmt->close();
            http_response_code(200);
            exit(json_encode(["status" => "success", "message" => "Song inserted successfully"]));
        } else {
            http_response_code(500);
            exit(json_encode(["status" => "error", "message" => "Failed to insert song"]));
        }
    }


    // HIGHLIFE  //HIGHLIFE MUSIC SECTION
    public function getSongsByIdentifier($identifier, $page = 1, $limit = 5)
    {
        $offset = ($page - 1) * $limit;
        $identifier = $this->conn->real_escape_string($identifier);

        //total songs by identifier
        $countSql = "SELECT COUNT(*) AS total FROM Songs WHERE song_identifier = '$identifier'";
        $countResult = $this->conn->query($countSql);
        $total = ($countResult && $countResult->num_rows > 0)
            ? $countResult->fetch_assoc()['total']
            : 0;

        // Fetch songs
        $sql = "SELECT 
                Songs.id, Songs.title, Songs.duration, Songs.path,  Songs.plays,
                albums.artworkPath,
                artists.name AS artistName,
                genres.name AS genreName
            FROM Songs
            JOIN albums ON Songs.album = albums.id
            JOIN artists ON Songs.artist = artists.id
            JOIN genres ON Songs.genre = genres.id
            WHERE Songs.song_identifier = '$identifier'
            ORDER BY Songs.id DESC
            LIMIT $offset, $limit";

        $result = $this->conn->query($sql);

        $songs = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $songs[] = $row;
            }
        }

        return [
            'songs' => $songs,
            'total' => $total,
            'limit' => $limit,
            'page' => $page,
            'pages' => ceil($total / $limit)
        ];
    }





    //artise section
    public function uploadArtiste($artists, $profile, $bio)
    {
        $sql = "INSERT INTO artists(name, artiste_profile, bio) VALUES(?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $artists, $profile, $bio);

        if ($stmt->execute()) {
            $stmt->close();
            http_response_code(200);
            exit(json_encode(["status" => "success", "message" => "Artise Uploaded successfully"]));
        } else {
            http_response_code(500);
            exit(json_encode(["status" => "error", "message" => "Failed to upload artiste"]));
        }
    }

    public function getAllArtistsForAdmin()
    {
        $sql = "SELECT * FROM artists";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $artists = [];
            while ($row = $result->fetch_assoc()) {
                $artists[] = $row;
            }
            return $artists;
        }

        return [];
    }
    public function getAllArtists($page = 1, $limit = 5)
    {
        //offset
        $offset = ($page - 1) * $limit;

        //total number of artists
        $countSql = "SELECT COUNT(*) AS total FROM artists";
        $countResult = $this->conn->query($countSql);
        $totalRows = $countResult->fetch_assoc()['total'];
        $totalPages = ceil($totalRows / $limit);

        // artists for this page
        $sql = "SELECT * FROM artists WHERE visibility = 'visible' LIMIT ?, ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $artists = [];
        while ($row = $result->fetch_assoc()) {
            $artists[] = $row;
        }

        return [
            "artists" => $artists,
            "totalPages" => $totalPages,
            "currentPage" => $page,
        ];
    }



    public function deleteArtiseByid($id)
    {
        $id = intval($id);
        $statement = $this->conn->prepare("DELETE FROM artists WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();

        if ($statement->affected_rows > 0) {
            $statement->close();
            http_response_code(200);
            exit(json_encode(["status" => "success", "message" => "Artiste deleted successfully"]));
        } else {
            http_response_code(500);
            exit(json_encode(["status" => "error", "message" => "Failed to delete Artiste"]));
        }
    }



    public function uploadAlbum($title,  $artist, $genre, $artworkPath)
    {
        $sql = "INSERT INTO albums (title, artist,  genre,  artworkPath)
    VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("siis", $title, $artist, $genre, $artworkPath);

        if ($stmt->execute()) {
            $stmt->close();
            http_response_code(200);
            exit(json_encode(["status" => "success", "message" => "Album inserted successfully"]));
        } else {
            http_response_code(500);
            exit(json_encode(["status" => "error", "message" => "Failed to insert Album"]));
        }
    }




    public function getAllAlbum($page = 1, $limit = 3)
    {
        $offset = ($page - 1) * $limit;

        // Count total albums
        $countSql = "SELECT COUNT(*) AS total FROM albums";
        $countResult = $this->conn->query($countSql);
        $total = ($countResult && $countResult->num_rows > 0)
            ? $countResult->fetch_assoc()['total']
            : 0;

        // Fetch albums with pagination
        $sql = "SELECT albums.*, 
                   artists.name AS artistName, 
                   genres.name AS genreName 
            FROM albums
            JOIN artists ON albums.artist = artists.id
            JOIN genres ON albums.genre = genres.id
            ORDER BY albums.id DESC
            LIMIT $offset, $limit";

        $result = $this->conn->query($sql);

        $albums = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $albums[] = $row;
            }
        }

        return [
            'albums' => $albums,
            'total' => $total,
            'limit' => $limit,
            'page' => $page,
            'pages' => ceil($total / $limit)
        ];
    }

    //get album for admin
    public function getAllAlbumForAdmin()
    {
        // Fetch albums without pagination
        $sql = "SELECT albums.*, 
                   artists.name AS artistName, 
                   genres.name AS genreName 
            FROM albums
            JOIN artists ON albums.artist = artists.id
            JOIN genres ON albums.genre = genres.id
            ORDER BY albums.id DESC";

        $result = $this->conn->query($sql);

        $albums = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $albums[] = $row;
            }
        }

        return  $albums;
    }
    public function getAlbumById($id)
    {
        $stmt = $this->conn->prepare(" SELECT  albums.*, 
            artists.name AS artistName, 
            artists.bio AS artistBio, 
            genres.name AS genreName
        FROM albums
        LEFT JOIN artists ON albums.artist = artists.id
        LEFT JOIN genres ON albums.genre = genres.id
        WHERE albums.id = ?
        ORDER BY id DESC
    ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getSongsByAlbumsForAbums($albumId)
    {
        $stmt = $this->conn->prepare(
            "SELECT songs.*, artists.name AS artistName, genres.name AS genreName
        FROM songs
        LEFT JOIN artists ON songs.artist = artists.id
        LEFT JOIN genres ON songs.genre = genres.id
        WHERE songs.album = ?
        ORDER BY songs.id DESC"
        );
        $stmt->bind_param("i", $albumId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

//get album teams and name 
public function getAlbumTeam($albumId) {
    $stmt = $this->conn->prepare("SELECT member_name, member_image FROM album_team WHERE album_id = ?");
    $stmt->bind_param("i", $albumId);
    $stmt->execute();
    $result = $stmt->get_result();

    $team = [];
    while ($row = $result->fetch_assoc()) {
        $team[] = $row;
    }

    $stmt->close();
    return $team;
}







    //  Fetch songs by album (with pagination)
    public function getSongsByAlbum($albumId, $page = 1, $limit = 7)
    {
        $albumId = intval($albumId);
        $offset = ($page - 1) * $limit;

        // Count total songs in album
        $countSql = "SELECT COUNT(*) AS total FROM Songs WHERE album = $albumId";
        $countResult = $this->conn->query($countSql);
        $total = ($countResult && $countResult->num_rows > 0)
            ? $countResult->fetch_assoc()['total']
            : 0;

        // Fetch songs
        $sql = "SELECT 
                Songs.id, Songs.title, Songs.duration, Songs.path, Songs.plays,
                albums.artworkPath,
                artists.name AS artistName,
                genres.name AS genreName
            FROM Songs
            JOIN albums ON Songs.album = albums.id
            JOIN artists ON Songs.artist = artists.id
            JOIN genres ON Songs.genre = genres.id
            WHERE Songs.album = $albumId
            ORDER BY Songs.id DESC
            LIMIT $offset, $limit";

        $result = $this->conn->query($sql);

        $songs = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $songs[] = $row;
            }
        }

        return [
            'songs' => $songs,
            'total' => $total,
            'limit' => $limit,
            'page' => $page,
            'pages' => ceil($total / $limit)
        ];
    }





    public function deleteAlbumByid($id)
    {
        $id = intval($id);
        $statement = $this->conn->prepare("DELETE FROM albums WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();

        if ($statement->affected_rows > 0) {
            $statement->close();
            http_response_code(200);
            exit(json_encode(["status" => "success", "message" => "Album deleted successfully"]));
        } else {
            http_response_code(500);
            exit(json_encode(["status" => "error", "message" => "Failed to delete Album"]));
        }
    }


    public function uploadGenre($genre)
    {
        $sql = "INSERT INTO genres(name) VALUES(?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $genre);

        if ($stmt->execute()) {
            $stmt->close();
            http_response_code(200);
            exit(json_encode(["status" => "success", "message" => "genre Uploaded successfully"]));
        } else {
            http_response_code(500);
            exit(json_encode(["status" => "error", "message" => "Failed to upload genre"]));
        }
    }

    public function getAllGenre()
    {
        $sql = "SELECT * FROM genres";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $artists = [];
            while ($row = $result->fetch_assoc()) {
                $artists[] = $row;
            }
            return $artists;
        }

        return [];
    }

    public function deleteGenreByid($id)
    {
        $id = intval($id);
        $statement = $this->conn->prepare("DELETE FROM genres WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();

        if ($statement->affected_rows > 0) {
            $statement->close();
            http_response_code(200);
            exit(json_encode(["status" => "success", "message" => "Genre deleted successfully"]));
        } else {
            http_response_code(500);
            exit(json_encode(["status" => "error", "message" => "Failed to delete Genre"]));
        }
    }
}
