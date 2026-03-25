<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../db.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$id     = isset($_GET['id']) ? intval($_GET['id']) : null;
$pdo    = getDB();

try {
    // GET — listar mensajes (para el dashboard)
    if ($metodo === 'GET') {
        $stmt = $pdo->query('SELECT * FROM contactos ORDER BY created_at DESC');
        echo json_encode($stmt->fetchAll());

    // POST — recibir mensaje desde contacto.php
    } elseif ($metodo === 'POST') {
        $datos = json_decode(file_get_contents('php://input'), true);

        if (empty($datos['nombre']) || empty($datos['correo']) || empty($datos['mensaje'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Nombre, correo y mensaje son obligatorios']);
            exit;
        }

        $stmt = $pdo->prepare('
            INSERT INTO contactos (nombre, correo, telefono, asunto, mensaje)
            VALUES (?, ?, ?, ?, ?)
        ');
        $stmt->execute([
            $datos['nombre'],
            $datos['correo'],
            $datos['telefono'] ?? '',
            $datos['asunto']   ?? '',
            $datos['mensaje'],
        ]);

        http_response_code(201);
        echo json_encode(['ok' => true]);

        // Enviar correo
        $para    = 'admin@pizzicato.mx'; // ← cambia por tu correo real
        $asunto  = 'Nuevo contacto: ' . ($datos['asunto'] ?? 'Sin asunto');
        $cuerpo  = "Nombre: {$datos['nombre']}\n";
        $cuerpo .= "Correo: {$datos['correo']}\n";
        $cuerpo .= "Teléfono: " . ($datos['telefono'] ?? '—') . "\n";
        $cuerpo .= "Asunto: " . ($datos['asunto'] ?? '—') . "\n\n";
        $cuerpo .= "Mensaje:\n{$datos['mensaje']}";
        $headers = "From: noreply@pizzicato.mx\r\nReply-To: {$datos['correo']}";
        @mail($para, $asunto, $cuerpo, $headers);

        

    // PUT — marcar como leído
    } elseif ($metodo === 'PUT') {
        if (!$id) { http_response_code(400); echo json_encode(['error' => 'Falta el id']); exit; }
        $pdo->prepare('UPDATE contactos SET leido = 1 WHERE id = ?')->execute([$id]);
        echo json_encode(['ok' => true]);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}