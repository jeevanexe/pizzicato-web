<?php
// =============================================
//  PIZZICATO — Conexión a la base de datos
//  Incluir este archivo en todas las páginas:
//  require_once __DIR__ . '/db.php';
// =============================================

define('DB_HOST', 'localhost');
define('DB_NAME', 'pizzicato');
define('DB_USER', 'root');       // En XAMPP el usuario es "root"
define('DB_PASS', '');           // En XAMPP la contraseña está vacía por defecto
define('DB_CHARSET', 'utf8mb4');

function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $opciones = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $opciones);
        } catch (PDOException $e) {
            http_response_code(500);
            die(json_encode([
                'error' => true,
                'mensaje' => 'No se pudo conectar a la base de datos. Verifica que MySQL esté activo en XAMPP.'
            ]));
        }
    }
    return $pdo;
}
