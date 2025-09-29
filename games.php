<?php
header('Content-Type: application/json'); // Return JSON only

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "games_shop";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the path from the URL
    $uri = $_SERVER['REQUEST_URI']; // e.g., /games.php/1
    $parts = explode('/', trim($uri, '/')); // split by /
    
    // Get the last part after games.php
    $id = null;
    foreach ($parts as $index => $part) {
        if (strpos($part, 'games.php') !== false) {
            if (isset($parts[$index + 1])) {
                $id = intval($parts[$index + 1]);
            }
            break;
        }
    }

    if ($id) {
        // Fetch game by ID
        $stmt = $conn->prepare("SELECT * FROM game WHERE GameID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $game = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($game) {
            echo json_encode($game);
        } else {
            http_response_code(404); // optional
            echo json_encode(['error' => 'Game not found']);
        }
    } else {
        // No ID, return all games
        $stmt = $conn->prepare("SELECT * FROM game");
        $stmt->execute();
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($games);
    }

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
