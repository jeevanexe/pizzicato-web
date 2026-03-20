<?php
// =============================================
//  API — Imágenes
//  GET    api/imagenes.php         → listar todas
//  POST   api/imagenes.php         → subir imagen (multipart/form-data)
//  DELETE api/imagenes.php?id=1    → eliminar
// =============================================

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../db.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$id     = isset($_GET['id']) ? intval($_GET['id']) : null;
$pdo    = getDB();

// Carpeta donde se guardan físicamente las imágenes
define('UPLOAD_DIR', __DIR__ . '/../uploads/imagenes/');
define('UPLOAD_URL', 'uploads/imagenes/');

// Crear la carpeta si no existe
if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}

try {
    if ($metodo === 'GET') {
        $tag = $_GET['tag'] ?? null;
        if ($tag) {
            $stmt = $pdo->prepare('SELECT * FROM imagenes WHERE tag = ? ORDER BY created_at DESC');
            $stmt->execute([$tag]);
        } else {
            $stmt = $pdo->query('SELECT * FROM imagenes ORDER BY created_at DESC');
        }
        echo json_encode($stmt->fetchAll());

    } elseif ($metodo === 'POST') {
        // Validar que llegó un archivo
        if (empty($_FILES['imagen'])) {
            http_response_code(400);
            echo json_encode(['error' => 'No se recibió ningún archivo']);
            exit;
        }

        $archivo = $_FILES['imagen'];
        $tag     = $_POST['tag'] ?? 'general';

        // Validar errores de subida
        if ($archivo['error'] !== UPLOAD_ERR_OK) {
            http_response_code(400);
            echo json_encode(['error' => 'Error al subir el archivo']);
            exit;
        }

        // Validar tamaño (máx 5 MB)
        if ($archivo['size'] > 5 * 1024 * 1024) {
            http_response_code(400);
            echo json_encode(['error' => 'La imagen supera los 5 MB']);
            exit;
        }

        // Validar tipo de archivo
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $tipoReal = finfo_file($finfo, $archivo['tmp_name']);
        finfo_close($finfo);

        if (!in_array($tipoReal, $tiposPermitidos)) {
            http_response_code(400);
            echo json_encode(['error' => 'Tipo de archivo no permitido. Solo JPG, PNG, WEBP o GIF']);
            exit;
        }

        // Generar nombre único para evitar colisiones
        $extension  = pathinfo($archivo['name'], PATHINFO_EXTENSION);
        $nombreUnico = uniqid('img_', true) . '.' . strtolower($extension);
        $rutaFisica  = UPLOAD_DIR . $nombreUnico;
        $rutaBD      = UPLOAD_URL . $nombreUnico;

        if (!move_uploaded_file($archivo['tmp_name'], $rutaFisica)) {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo guardar el archivo en el servidor']);
            exit;
        }

        // Guardar en la base de datos
        $stmt = $pdo->prepare('INSERT INTO imagenes (url, nombre, tag) VALUES (?, ?, ?)');
        $stmt->execute([$rutaBD, $archivo['name'], $tag]);

        http_response_code(201);
        echo json_encode([
            'ok'     => true,
            'id'     => $pdo->lastInsertId(),
            'url'    => $rutaBD,
            'nombre' => $archivo['name'],
            'tag'    => $tag,
        ]);

    } elseif ($metodo === 'DELETE') {
        if (!$id) { http_response_code(400); echo json_encode(['error' => 'Falta el id']); exit; }

        // Obtener la URL para borrar el archivo físico
        $stmt = $pdo->prepare('SELECT url FROM imagenes WHERE id = ?');
        $stmt->execute([$id]);
        $img = $stmt->fetch();

        if ($img) {
            $rutaFisica = __DIR__ . '/../' . $img['url'];
            if (file_exists($rutaFisica)) {
                unlink($rutaFisica);
            }
        }

        $pdo->prepare('DELETE FROM imagenes WHERE id = ?')->execute([$id]);
        echo json_encode(['ok' => true]);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
