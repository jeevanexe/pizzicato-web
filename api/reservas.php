<?php
// =============================================
//  API — Reservas
//  GET  api/reservas.php           → listar todas (dashboard)
//  POST api/reservas.php           → crear reserva (desde reserva.php)
//  PUT  api/reservas.php?id=1      → cambiar estado
// =============================================

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/api_auth.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$id     = isset($_GET['id']) ? intval($_GET['id']) : null;
$pdo    = getDB();

try {
    if ($metodo === 'GET') {
        requireAdminAuth();
        // Listar reservas con info de usuario, clase y horario
        $stmt = $pdo->query('
            SELECT
                r.id,
                r.fecha,
                r.estado,
                r.notas,
                r.nivel_musical,        
                r.tiene_instrumento,    
                r.created_at,
                u.nombre    AS alumno_nombre,
                u.apellido  AS alumno_apellido,
                u.correo    AS alumno_correo,
                u.tel       AS alumno_tel,
                c.nombre    AS clase_nombre,
                c.precio    AS clase_precio,
                h.dia_semana,
                h.hora
            FROM reservas r
            JOIN usuarios u ON u.id = r.usuario_id
            JOIN clases   c ON c.id = r.clase_id
            JOIN horarios h ON h.id = r.horario_id
            ORDER BY r.created_at DESC
        ');
        echo json_encode($stmt->fetchAll());

    } elseif ($metodo === 'POST') {
        $datos = json_decode(file_get_contents('php://input'), true);

        // Campos requeridos
        $requeridos = ['nombre', 'apellido', 'correo', 'clase_id', 'horario_id', 'fecha'];
        foreach ($requeridos as $campo) {
            if (empty($datos[$campo])) {
                http_response_code(400);
                echo json_encode(['error' => "El campo '$campo' es obligatorio"]);
                exit;
            }
        }

        $pdo->beginTransaction();

        // Buscar si el usuario ya existe por correo, si no, crearlo
        $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE correo = ?');
        $stmt->execute([$datos['correo']]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            $usuarioId = $usuario['id'];
        } else {
            $stmt = $pdo->prepare('
                INSERT INTO usuarios (nombre, apellido, correo, contrasena, tel, rol)
                VALUES (?, ?, ?, ?, ?, "alumno")
            ');
            // Contraseña temporal aleatoria (el alumno puede recuperarla después)
            $passTemp = password_hash(bin2hex(random_bytes(8)), PASSWORD_DEFAULT);
            $stmt->execute([
                $datos['nombre'],
                $datos['apellido'],
                $datos['correo'],
                $passTemp,
                $datos['tel'] ?? '',
            ]);
            $usuarioId = $pdo->lastInsertId();
        }

        // Crear la reserva
        $stmt = $pdo->prepare('
            INSERT INTO reservas (usuario_id, clase_id, horario_id, fecha, notas, nivel_musical, tiene_instrumento)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');
        $stmt->execute([
            $usuarioId,
            intval($datos['clase_id']),
            intval($datos['horario_id']),
            $datos['fecha'],
            $datos['notas'] ?? '',
            $datos['nivel_musical'] ?? '',
            $datos['tiene_instrumento'] ?? '',
        ]);
        $reservaId = $pdo->lastInsertId();

        $pdo->commit();
        http_response_code(201);
        echo json_encode(['ok' => true, 'reserva_id' => $reservaId, 'usuario_id' => $usuarioId]);

    } elseif ($metodo === 'PUT') {
        requireAdminAuth();
        if (!$id) { http_response_code(400); echo json_encode(['error' => 'Falta el id']); exit; }
        $datos = json_decode(file_get_contents('php://input'), true);
        $stmt  = $pdo->prepare('UPDATE reservas SET estado = ? WHERE id = ?');
        $stmt->execute([$datos['estado'] ?? 'pendiente', $id]);
        echo json_encode(['ok' => true]);
    }

} catch (PDOException $e) {
    $pdo->rollBack();
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
