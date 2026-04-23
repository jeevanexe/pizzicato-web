<?php
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => isset($_SERVER['HTTPS']), // Only secure if using HTTPS
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
    header('Location: dashboard.php'); exit;
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Token CSRF inválido.');
    }

    require_once 'db.php';
    $pdo  = getDB();
    $stmt = $pdo->prepare('SELECT id, nombre, contrasena, rol FROM usuarios WHERE correo = ?');
    $stmt->execute([trim($_POST['correo'])]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['contrasena'], $user['contrasena']) && $user['rol'] === 'admin') {
        session_regenerate_id(true); // Prevent Session Fixation
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['nombre']     = $user['nombre'];
        $_SESSION['rol']        = $user['rol'];
        header('Location: dashboard.php'); exit;
    } else {
        $error = 'Correo, contraseña incorrectos o sin acceso.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso | Pizzicato</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --brown: #8B4513; --cream: #FFF8F0; --light: #F5E6D3; --dark: #2D2424; }
        body { background: var(--cream); font-family: 'DM Sans', sans-serif; color: var(--dark); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { background: white; border-radius: 1.25rem; padding: 2.5rem; width: 100%; max-width: 22rem; box-shadow: 0 8px 32px rgba(0,0,0,0.08); }
        .logo { text-align: center; margin-bottom: 2rem; }
        .logo h1 { font-family: 'Playfair Display', serif; font-size: 1.8rem; color: var(--brown); }
        .logo p { font-size: 0.8rem; color: rgba(45,36,36,0.5); margin-top: 0.25rem; }
        label { font-size: 0.78rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.08em; color: rgba(45,36,36,0.6); display: block; margin-bottom: 0.4rem; }
        input { width: 100%; border: 1px solid var(--light); border-radius: 0.75rem; padding: 0.75rem 1rem; font-size: 0.9rem; font-family: 'DM Sans', sans-serif; outline: none; transition: border-color 0.2s; margin-bottom: 1rem; }
        input:focus { border-color: var(--brown); box-shadow: 0 0 0 3px rgba(139,69,19,0.12); }
        .btn { width: 100%; background: var(--brown); color: white; border: none; border-radius: 9999px; padding: 0.85rem; font-size: 0.9rem; font-weight: 500; font-family: 'DM Sans', sans-serif; cursor: pointer; transition: background 0.2s; margin-top: 0.5rem; }
        .btn:hover { background: #6B3410; }
        .error { background: #fef2f2; border: 1px solid #fecaca; border-radius: 0.75rem; padding: 0.75rem 1rem; color: #dc2626; font-size: 0.85rem; margin-bottom: 1rem; }
    </style>
</head>
<body>
<div class="card">
    <div class="logo">
        <h1>Pizzicato</h1>
        <p>Acceso exclusivo para profesores</p>
    </div>
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <label>Correo electrónico</label>
        <input type="email" name="correo" required autofocus>
        <label>Contraseña</label>
        <input type="password" name="contrasena" required>
        <button class="btn" type="submit">Entrar</button>
    </form>
</div>
</body>
</html>