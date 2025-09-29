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

    $method = $_SERVER['REQUEST_METHOD'];

    $uri = $_SERVER['REQUEST_URI'];
    $parts = explode('/', trim($uri, '/'));
    $id = null;
    foreach ($parts as $index => $part) {
        if (strpos($part, 'games.php') !== false) {
            if (isset($parts[$index + 1])) {
                $id = intval($parts[$index + 1]);
            }
            break;
        }
    }

    if ($method === 'GET') {
        $genre = isset($_GET['genre']) ? $_GET['genre'] : null;

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
    }

    elseif ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!empty($data['Title']) && !empty($data['Genre']) && isset($data['Price'])) {
            $stmt = $conn->prepare("INSERT INTO game (Title, Genre, Price) VALUES (:title, :genre, :price)");
            $stmt->bindParam(':title', $data['Title']);
            $stmt->bindParam(':genre', $data['Genre']);
            $stmt->bindParam(':price', $data['Price']);
            $stmt->execute();

            echo json_encode([
                'success' => true,
                'message' => 'Game added successfully',
                'GameID' => $conn->lastInsertId()
            ]);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields']);
        }
    }

    elseif ($method === 'DELETE') {
        if ($id) {
            $stmt = $conn->prepare("DELETE FROM game WHERE GameID = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo json_encode([
                    'success' => true,
                    'message' => "Game with ID $id deleted successfully"
                ]);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Game not found']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing GameID for deletion']);
        }
    }

    elseif ($method === 'PATCH') {
        if ($id) {
            $data = json_decode(file_get_contents('php://input'), true);
            $fields = [];
            $params = [];

            // Add only fields that are present
            if (isset($data['Title'])) {
                $fields[] = "Title = :title";
                $params[':title'] = $data['Title'];
            }
            if (isset($data['Genre'])) {
                $fields[] = "Genre = :genre";
                $params[':genre'] = $data['Genre'];
            }
            if (isset($data['Price'])) {
                $fields[] = "Price = :price";
                $params[':price'] = $data['Price'];
            }

            if (count($fields) > 0) {
                $sql = "UPDATE game SET " . implode(", ", $fields) . " WHERE GameID = :id";
                $stmt = $conn->prepare($sql);
                $params[':id'] = $id;
                foreach ($params as $key => $val) {
                    $stmt->bindValue($key, $val);
                }
                $stmt->execute();

                echo json_encode([
                    'success' => true,
                    'message' => "Game with ID $id updated successfully"
                ]);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'No fields to update']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing GameID for update']);
        }
    }

    else {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
    }

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
