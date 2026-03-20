<?php
// =============================================
//  API — Clases
//  GET    api/clases.php          → listar todas
//  GET    api/clases.php?id=1     → obtener una
//  POST   api/clases.php          → crear nueva
//  PUT    api/clases.php?id=1     → editar
//  DELETE api/clases.php?id=1     → eliminar
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
    // ── GET ──────────────────────────────────
    if ($metodo === 'GET') {
        if ($id) {
            // Una clase con sus horarios
            $stmt = $pdo->prepare('SELECT * FROM clases WHERE id = ?');
            $stmt->execute([$id]);
            $clase = $stmt->fetch();
            if (!$clase) { http_response_code(404); echo json_encode(['error' => 'Clase no encontrada']); exit; }

            $stmt2 = $pdo->prepare('SELECT id, dia_semana, hora FROM horarios WHERE clase_id = ? ORDER BY FIELD(dia_semana,"lunes","martes","miercoles","jueves","viernes","sabado","domingo"), hora');
            $stmt2->execute([$id]);
            $clase['horarios'] = $stmt2->fetchAll();
            echo json_encode($clase);
        } else {
            // Todas las clases con sus horarios
            $clases = $pdo->query('SELECT * FROM clases ORDER BY nombre')->fetchAll();
            foreach ($clases as &$clase) {
                $stmt = $pdo->prepare('SELECT id, dia_semana, hora FROM horarios WHERE clase_id = ? ORDER BY FIELD(dia_semana,"lunes","martes","miercoles","jueves","viernes","sabado","domingo"), hora');
                $stmt->execute([$clase['id']]);
                $clase['horarios'] = $stmt->fetchAll();
            }
            echo json_encode($clases);
        }

    // ── POST ─────────────────────────────────
    } elseif ($metodo === 'POST') {
        $datos = json_decode(file_get_contents('php://input'), true);
        if (!$datos || empty($datos['nombre'])) {
            http_response_code(400);
            echo json_encode(['error' => 'El nombre es obligatorio']);
            exit;
        }

        $pdo->beginTransaction();

        $stmt = $pdo->prepare('
            INSERT INTO clases (nombre, profesor, instrumento, nivel, duracion, precio, descripcion, imagen_url, estado)
            VALUES (:nombre, :profesor, :instrumento, :nivel, :duracion, :precio, :descripcion, :imagen_url, :estado)
        ');
        $stmt->execute([
            ':nombre'      => $datos['nombre'],
            ':profesor'    => $datos['profesor']    ?? '',
            ':instrumento' => $datos['instrumento'] ?? 'otro',
            ':nivel'       => $datos['nivel']       ?? 'todos',
            ':duracion'    => $datos['duracion']    ?? 60,
            ':precio'      => $datos['precio']      ?? 0,
            ':descripcion' => $datos['descripcion'] ?? '',
            ':imagen_url'  => $datos['imagen_url']  ?? '',
            ':estado'      => $datos['estado']      ?? 'activa',
        ]);
        $claseId = $pdo->lastInsertId();

        // Insertar horarios
        if (!empty($datos['horarios']) && is_array($datos['horarios'])) {
            $stmtH = $pdo->prepare('INSERT INTO horarios (clase_id, dia_semana, hora) VALUES (?, ?, ?)');
            foreach ($datos['horarios'] as $h) {
                if (!empty($h['dia_semana']) && !empty($h['hora'])) {
                    $stmtH->execute([$claseId, $h['dia_semana'], $h['hora']]);
                }
            }
        }

        $pdo->commit();
        http_response_code(201);
        echo json_encode(['ok' => true, 'id' => $claseId]);

    // ── PUT ──────────────────────────────────
    } elseif ($metodo === 'PUT') {
        if (!$id) { http_response_code(400); echo json_encode(['error' => 'Falta el id']); exit; }
        $datos = json_decode(file_get_contents('php://input'), true);

        $pdo->beginTransaction();

        $stmt = $pdo->prepare('
            UPDATE clases SET
                nombre       = :nombre,
                profesor     = :profesor,
                instrumento  = :instrumento,
                nivel        = :nivel,
                duracion     = :duracion,
                precio       = :precio,
                descripcion  = :descripcion,
                imagen_url   = :imagen_url,
                estado       = :estado
            WHERE id = :id
        ');
        $stmt->execute([
            ':nombre'      => $datos['nombre'],
            ':profesor'    => $datos['profesor']    ?? '',
            ':instrumento' => $datos['instrumento'] ?? 'otro',
            ':nivel'       => $datos['nivel']       ?? 'todos',
            ':duracion'    => $datos['duracion']    ?? 60,
            ':precio'      => $datos['precio']      ?? 0,
            ':descripcion' => $datos['descripcion'] ?? '',
            ':imagen_url'  => $datos['imagen_url']  ?? '',
            ':estado'      => $datos['estado']      ?? 'activa',
            ':id'          => $id,
        ]);

        // Reemplazar horarios: borrar los viejos e insertar los nuevos
        $pdo->prepare('DELETE FROM horarios WHERE clase_id = ?')->execute([$id]);
        if (!empty($datos['horarios']) && is_array($datos['horarios'])) {
            $stmtH = $pdo->prepare('INSERT INTO horarios (clase_id, dia_semana, hora) VALUES (?, ?, ?)');
            foreach ($datos['horarios'] as $h) {
                if (!empty($h['dia_semana']) && !empty($h['hora'])) {
                    $stmtH->execute([$id, $h['dia_semana'], $h['hora']]);
                }
            }
        }

        $pdo->commit();
        echo json_encode(['ok' => true]);

    // ── DELETE ───────────────────────────────
    } elseif ($metodo === 'DELETE') {
        if (!$id) { http_response_code(400); echo json_encode(['error' => 'Falta el id']); exit; }
        // Los horarios se eliminan solos por CASCADE
        $pdo->prepare('DELETE FROM clases WHERE id = ?')->execute([$id]);
        echo json_encode(['ok' => true]);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
