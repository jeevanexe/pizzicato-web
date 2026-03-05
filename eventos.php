<?php
// Configuración de datos de la escuela
$nombreEstudio = "Pizzicato";
$anioActual = date("Y");



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzicato | Estudio de Artes Musicales</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <div class="logo">
            <div class="logo-icon"><i class="fas fa-music"></i></div>
            <div>
                <strong>Pizzicato</strong><br>
                <small style="font-size: 0.6rem; color: #777;">Estudio de Artes Musicales</small>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="home.php">Inicio</a></li>
                <li><a href="clases.php">Clases</a></li>
                <li><a href="eventos.php">Eventos</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </nav>
        <a href="#" class="btn-reserva">RESERVAR CLASE</a>
    </header>

   

</body>
</html>