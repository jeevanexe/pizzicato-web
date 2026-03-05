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

    <section class="hero">
        <span>BIENVENIDO A PIZZICATO</span>
        <h1>Estudio de <br><span>Artes Musicales</span></h1>
        <p>Descubre tu talento musical con nosotros. Clases personalizadas de piano, guitarra, canto y más instrumentos.</p>
        <div class="hero-btns">
            <a href="#" class="btn-primary">VER CLASES <i class="fas fa-arrow-right"></i></a>
            <a href="#" class="btn-secondary">CONTACTAR</a>
        </div>
    </section>

    <section class="features">
        <small style="color: var(--primary-brown); letter-spacing: 2px;">POR QUÉ ELEGIRNOS</small>
        <h2 style="font-size: 2.5rem; margin-top: 10px;">Tu escuela de artes musicales</h2>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-music"></i>
                <h3>Variedad de Instrumentos</h3>
                <p>Piano, guitarra, canto, violín y más. Encuentra el instrumento perfecto para ti.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-users"></i>
                <h3>Profesores Expertos</h3>
                <p>Aprende con músicos profesionales con años de experiencia en la enseñanza.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-award"></i>
                <h3>Todos los Niveles</h3>
                <p>Desde principiantes hasta avanzados. Adaptamos las clases a tu nivel.</p>
            </div>
        </div>
    </section>

    <section class="about">
        <div class="about-image">
            <img src="https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800" alt="Estudio">
            <div class="rating-badge">
                <i class="fas fa-star" style="color: var(--primary-brown);"></i>
                <div><strong>4.9</strong><br><small>Valoración</small></div>
            </div>
        </div>
        <div class="about-content">
            <small style="color: var(--primary-brown);">SOBRE NOSOTROS</small>
            <h2 style="font-size: 2.5rem; margin: 10px 0;">Más de 10 años formando músicos</h2>
            <p>En Pizzicato creemos que la música es un lenguaje universal que todos pueden aprender. Nuestra misión es proporcionar educación musical de calidad en un ambiente acogedor y profesional.</p>
            <div class="stats-grid">
                <div class="stat-item"><h3>10+</h3><p>Años de experiencia</p></div>
                <div class="stat-item"><h3>30+</h3><p>Alumnos activos</p></div>
                <div class="stat-item"><h3>1</h3><p>Profesor</p></div>
                <div class="stat-item"><h3>10+</h3><p>Clases semanales</p></div>
            </div>
        </div>
    </section>

    <section class="classes">
        <div style="display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <small style="color: var(--primary-brown);">NUESTRAS CLASES</small>
                <h2 style="font-size: 2.5rem;">Encuentra tu instrumento</h2>
            </div>
            <a href="#" style="color: var(--primary-brown); text-decoration: none;">Ver todas las clases →</a>
        </div>

        <div class="class-grid">
            <div class="class-card">
                <div class="class-img" style="background-image: url('https://images.unsplash.com/photo-1520522118941-d46427870f4d?auto=format&fit=crop&q=80&w=500');">
                    <span class="prof-tag">PROF. Jhonathan Catalan</span>
                </div>
                <div class="class-info">
                    <div><h3>Piano</h3><small><i class="far fa-clock"></i> 50 min</small></div>
                    <div style="color: var(--primary-brown); font-weight: bold; font-size: 1.2rem;">$800</div>
                </div>
            </div>
            <div class="class-card">
                <div class="class-img" style="background-image: url('https://images.unsplash.com/photo-1525201548942-d8732f6617a0?auto=format&fit=crop&q=80&w=500');">
                    <span class="prof-tag">PROF. Jhonathan Catalan</span>
                </div>
                <div class="class-info">
                    <div><h3>Guitarra</h3><small><i class="far fa-clock"></i> 50 min</small></div>
                    <div style="color: var(--primary-brown); font-weight: bold; font-size: 1.2rem;">$800</div>
                </div>
            </div>
            <div class="class-card">
                <div class="class-img" style="background-image: url('https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&q=80&w=500');">
                    <span class="prof-tag">PROF. Jhonathan Catalan</span>
                </div>
                <div class="class-info">
                    <div><h3>Canto</h3><small><i class="far fa-clock"></i> 50 min</small></div>
                    <div style="color: var(--primary-brown); font-weight: bold; font-size: 1.2rem;">$800</div>
                </div>
            </div>
        </div>
    </section>

    <section style="text-align: center; padding: 5rem 10%;">
        <h2 style="font-size: 3rem; margin-bottom: 1rem;">¿Listo para comenzar?</h2>
        <p style="margin-bottom: 2rem;">Reserva tu primera clase y descubre tu potencial musical.</p>
        <a href="#" class="btn-primary" style="display: inline-flex; margin: 0 auto;">Reservar Clase <i class="fas fa-arrow-right"></i></a>
    </section>

    <footer>
        <div class="footer-grid">
            <div class="footer-col">
                <div class="logo" style="margin-bottom: 1rem;">
                    <div class="logo-icon"><i class="fas fa-music"></i></div>
                    <strong style="color: white;">Pizzicato</strong>
                </div>
                <p>Descubre tu talento musical. Clases de piano, guitarra, canto y más.</p>
            </div>
            <div class="footer-col">
                <h4>NAVEGACIÓN</h4>
                <ul>
                    <li>Inicio</li>
                    <li>Clases</li>
                    <li>Eventos</li>
                    <li>Contacto</li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>CONTACTO</h4>
                <ul>
                    <li><i class="fas fa-envelope"></i> info@pizzicato.mx</li>
                    <li><i class="fas fa-map-marker-alt"></i> Av. 4 de Marzo & Rtno. 7, Payo Obispo, 77083, Chetumal, Q.R.</li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>SÍGUENOS</h4>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
        </div>
        <div class="copyright">
            © 2026 Estudio de Artes Musicales Pizzicato. Todos los derechos reservados.
        </div>
    </footer>

</body>
</html>