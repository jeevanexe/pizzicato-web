<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../db.php';
$metodo = $_SERVER['REQUEST_METHOD'];
$id     = isset($_GET['id']) ? intval($_GET['id']) : null;
$pdo    = getDB();

try {
    if ($metodo === 'POST') {
        $datos = json_decode(file_get_contents('php://input'), true);
        if (empty($datos['clase_id']) || empty($datos['fecha']) || empty($datos['hora'])) {
            http_response_code(400);
            echo json_encode(['error' => 'clase_id, fecha y hora son obligatorios']);
            exit;
        }
        $stmt = $pdo->prepare('
            INSERT INTO horarios_especificos (clase_id, fecha, hora, tipo)
            VALUES (?, ?, ?, ?)
        ');
        $stmt->execute([
            $datos['clase_id'],
            $datos['fecha'],
            $datos['hora'],
            $datos['tipo'] ?? 'extra',
        ]);
        echo json_encode(['ok' => true, 'id' => $pdo->lastInsertId()]);

    } elseif ($metodo === 'DELETE') {
        if (!$id) { http_response_code(400); echo json_encode(['error' => 'Falta el id']); exit; }
        $pdo->prepare('DELETE FROM horarios_especificos WHERE id = ?')->execute([$id]);
        echo json_encode(['ok' => true]);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}