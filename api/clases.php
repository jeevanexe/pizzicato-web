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
require_once __DIR__ . '/api_auth.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$id     = isset($_GET['id']) ? intval($_GET['id']) : null;
$pdo    = getDB();

try {
    // ── GET ──────────────────────────────────
    if ($metodo === 'GET') {
        if ($id) {
            // Una clase con sus horarios recurrentes y específicos
            $stmt = $pdo->prepare('SELECT * FROM clases WHERE id = ?');
            $stmt->execute([$id]);
            $clase = $stmt->fetch();
            if (!$clase) { http_response_code(404); echo json_encode(['error' => 'Clase no encontrada']); exit; }

            // Horarios recurrentes
            $stmt2 = $pdo->prepare('SELECT id, dia_semana, hora FROM horarios WHERE clase_id = ? ORDER BY FIELD(dia_semana,"lunes","martes","miercoles","jueves","viernes","sabado","domingo"), hora');
            $stmt2->execute([$id]);
            $clase['horarios'] = $stmt2->fetchAll();

            // Horarios específicos (solo desde hoy en adelante)
            $stmt3 = $pdo->prepare('SELECT id, fecha, hora, tipo FROM horarios_especificos WHERE clase_id = ? AND fecha >= CURDATE() ORDER BY fecha ASC, hora ASC');
            $stmt3->execute([$id]);
            $clase['horarios_especificos'] = $stmt3->fetchAll();

            echo json_encode($clase);
        } else {
            // Todas las clases con sus horarios recurrentes y específicos
            $clases = $pdo->query('SELECT * FROM clases ORDER BY nombre')->fetchAll();
            foreach ($clases as &$clase) {
                // Horarios recurrentes
                $stmt = $pdo->prepare('SELECT id, dia_semana, hora FROM horarios WHERE clase_id = ? ORDER BY FIELD(dia_semana,"lunes","martes","miercoles","jueves","viernes","sabado","domingo"), hora');
                $stmt->execute([$clase['id']]);
                $clase['horarios'] = $stmt->fetchAll();

                // Horarios específicos (solo desde hoy en adelante)
                $stmt2 = $pdo->prepare('SELECT id, fecha, hora, tipo FROM horarios_especificos WHERE clase_id = ? AND fecha >= CURDATE() ORDER BY fecha ASC, hora ASC');
                $stmt2->execute([$clase['id']]);
                $clase['horarios_especificos'] = $stmt2->fetchAll();
            }
            echo json_encode($clases);
        }

    // ── POST ─────────────────────────────────
    } elseif ($metodo === 'POST') {
        requireAdminAuth();
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

        // Insertar horarios recurrentes
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
        requireAdminAuth();
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

        // Reemplazar horarios recurrentes: borrar los viejos e insertar los nuevos
        $pdo->prepare('DELETE FROM horarios WHERE clase_id = ?')->execute([$id]);
        if (!empty($datos['horarios']) && is_array($datos['horarios'])) {
            $stmtH = $pdo->prepare('INSERT INTO horarios (clase_id, dia_semana, hora) VALUES (?, ?, ?)');
            foreach ($datos['horarios'] as $h) {
                if (!empty($h['dia_semana']) && !empty($h['hora'])) {
                    $stmtH->execute([$id, $h['dia_semana'], $h['hora']]);
                }
            }
        }

        // Nota: los horarios específicos se manejan por separado
        // desde api/horarios_especificos.php (POST para crear, DELETE para borrar)

        $pdo->commit();
        echo json_encode(['ok' => true]);

    // ── DELETE ───────────────────────────────
    } elseif ($metodo === 'DELETE') {
        requireAdminAuth();
        if (!$id) { http_response_code(400); echo json_encode(['error' => 'Falta el id']); exit; }
        // Los horarios recurrentes y específicos se eliminan por CASCADE
        $pdo->prepare('DELETE FROM clases WHERE id = ?')->execute([$id]);
        echo json_encode(['ok' => true]);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}