<?php
// =============================================
//  API — Eventos
//  GET    api/eventos.php          → listar todos
//  GET    api/eventos.php?id=1     → obtener uno
//  POST   api/eventos.php          → crear nuevo
//  PUT    api/eventos.php?id=1     → editar
//  DELETE api/eventos.php?id=1     → eliminar
// =============================================

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../db.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$id     = isset($_GET['id']) ? intval($_GET['id']) : null;
$pdo    = getDB();

try {
    if ($metodo === 'GET') {
        if ($id) {
            $stmt = $pdo->prepare('SELECT * FROM eventos WHERE id = ?');
            $stmt->execute([$id]);
            $evento = $stmt->fetch();
            if (!$evento) { http_response_code(404); echo json_encode(['error' => 'Evento no encontrado']); exit; }
            echo json_encode($evento);
        } else {
            $estado = $_GET['estado'] ?? null;
            if ($estado) {
                $stmt = $pdo->prepare('SELECT * FROM eventos WHERE estado = ? ORDER BY fecha ASC');
                $stmt->execute([$estado]);
            } else {
                $stmt = $pdo->query('SELECT * FROM eventos ORDER BY fecha ASC');
            }
            echo json_encode($stmt->fetchAll());
        }

    } elseif ($metodo === 'POST') {
        $datos = json_decode(file_get_contents('php://input'), true);
        if (!$datos || empty($datos['nombre']) || empty($datos['fecha'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Nombre y fecha son obligatorios']);
            exit;
        }
        $stmt = $pdo->prepare('
            INSERT INTO eventos (nombre, fecha, hora, lugar, precio_entrada, descripcion, imagen_url, estado)
            VALUES (:nombre, :fecha, :hora, :lugar, :precio_entrada, :descripcion, :imagen_url, :estado)
        ');
        $stmt->execute([
            ':nombre'         => $datos['nombre'],
            ':fecha'          => $datos['fecha'],
            ':hora'           => $datos['hora']           ?? null,
            ':lugar'          => $datos['lugar']          ?? '',
            ':precio_entrada' => $datos['precio_entrada'] ?? 'Gratis',
            ':descripcion'    => $datos['descripcion']    ?? '',
            ':imagen_url'     => $datos['imagen_url']     ?? '',
            ':estado'         => $datos['estado']         ?? 'proximo',
        ]);
        http_response_code(201);
        echo json_encode(['ok' => true, 'id' => $pdo->lastInsertId()]);

    } elseif ($metodo === 'PUT') {
        if (!$id) { http_response_code(400); echo json_encode(['error' => 'Falta el id']); exit; }
        $datos = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare('
            UPDATE eventos SET
                nombre         = :nombre,
                fecha          = :fecha,
                hora           = :hora,
                lugar          = :lugar,
                precio_entrada = :precio_entrada,
                descripcion    = :descripcion,
                imagen_url     = :imagen_url,
                estado         = :estado
            WHERE id = :id
        ');
        $stmt->execute([
            ':nombre'         => $datos['nombre'],
            ':fecha'          => $datos['fecha'],
            ':hora'           => $datos['hora']           ?? null,
            ':lugar'          => $datos['lugar']          ?? '',
            ':precio_entrada' => $datos['precio_entrada'] ?? 'Gratis',
            ':descripcion'    => $datos['descripcion']    ?? '',
            ':imagen_url'     => $datos['imagen_url']     ?? '',
            ':estado'         => $datos['estado']         ?? 'proximo',
            ':id'             => $id,
        ]);
        echo json_encode(['ok' => true]);

    } elseif ($metodo === 'DELETE') {
        if (!$id) { http_response_code(400); echo json_encode(['error' => 'Falta el id']); exit; }
        $pdo->prepare('DELETE FROM eventos WHERE id = ?')->execute([$id]);
        echo json_encode(['ok' => true]);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
