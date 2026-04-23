<?php
// API Authentication configuration
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();

function requireAdminAuth() {
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
        http_response_code(401);
        echo json_encode(['error' => 'Acceso denegado. Se requiere rol de administrador.']);
        exit;
    }
}
