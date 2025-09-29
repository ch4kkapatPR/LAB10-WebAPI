<?php
header('Content-Type: application/json'); 

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "games_shop";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $uri = $_SERVER['REQUEST_URI'];
    $parts = explode('/', trim($uri, '/')); 

    $id = null;
    $genre = isset($_GET['genre']) ? $_GET['genre'] : null;

    foreach ($parts as $index => $part) {
        if (strpos($part, 'games.php') !== false) {
            if (isset($parts[$index + 1])) {
                $id = intval($parts[$index + 1]);
            }
            break;
        }
    }

    if ($id) {
        $stmt = $conn->prepare("SELECT * FROM game WHERE GameID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $game = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($game) {
            echo json_encode($game);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Game not found']);
        }

    } elseif ($genre) {
        $stmt = $conn->prepare("SELECT * FROM game WHERE Genre LIKE :genre");
        $searchGenre = "%$genre%";
        $stmt->bindParam(':genre', $searchGenre, PDO::PARAM_STR);
        $stmt->execute();
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($games) {
            echo json_encode($games);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'No games found for this genre']);
        }

    } else {
        $stmt = $conn->prepare("SELECT * FROM game");
        $stmt->execute();
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($games);
    }

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
