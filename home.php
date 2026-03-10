<?php
$nombreEstudio = "Pizzicato";
$anioActual = date("Y");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Pizzicato - Estudio de Artes Musicales</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --brown: #8B4513;
            --dark:  #2D2424;
            --dark2:   #2D2D2D;
            --cream: #FFF8F0;
            --light: #F5E6D3;
            --gold:  #D4AF37;
        }

        body {
            background: var(--cream);
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            min-height: 100vh;
        }

        /* ── HEADER ── */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--cream);
            border-bottom: 1px solid var(--light);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2.5rem;
            gap: 1rem;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--dark);
        }
        .logo-icon {
            width: 2.5rem; height: 2.5rem;
            background: var(--brown);
            border-radius: 0.6rem;
            display: flex; align-items: center; justify-content: center;
            color: white;
        }
        .logo strong {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            display: block;
            line-height: 1.1;
        }
        .logo small { font-size: 0.6rem; color: #777; }

        nav ul { list-style: none; display: flex; gap: 2rem; }
        nav ul li a {
            text-decoration: none;
            font-size: 0.9rem;
            color: rgba(45,36,36,0.7);
            transition: color 0.2s;
        }
        nav ul li a:hover,
        nav ul li a.active { color: var(--brown); }

        .btn-reserva {
            padding: 0.6rem 1.4rem;
            background: var(--brown);
            color: white;
            border-radius: 9999px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            white-space: nowrap;
            transition: background 0.25s;
        }
        .btn-reserva:hover { background: #6B3410; }

        @media (max-width: 768px) {
            nav { display: none; }
            header { padding: 1rem 1.25rem; }
        }

        /* ── HERO ── */
        .hero {
            min-height: 88vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 6rem 10%;
            background:
                linear-gradient(to bottom right, rgba(255,248,240,0.97) 45%, rgba(245,230,211,0.6) 100%),
                url('https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=1600') center/cover no-repeat;
        }
        .hero-eyebrow {
            display: inline-block;
            color: var(--brown);
            font-size: 0.72rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            font-weight: 500;
            margin-bottom: 1.25rem;
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.8rem, 6vw, 5rem);
            color: var(--dark);
            line-height: 1.1;
            margin-bottom: 1.5rem;
            max-width: 36rem;
        }
        .hero h1 span { color: var(--brown); font-style: italic; }
        .hero > p {
            font-size: 1.1rem;
            color: rgba(45,36,36,0.65);
            line-height: 1.75;
            max-width: 30rem;
            margin-bottom: 2.5rem;
        }
        .hero-btns { display: flex; gap: 1rem; flex-wrap: wrap; }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.9rem 2rem;
            background: var(--brown);
            color: white;
            border-radius: 9999px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            transition: background 0.25s;
        }
        .btn-primary:hover { background: #6B3410; }
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            padding: 0.9rem 2rem;
            border: 1.5px solid var(--light);
            color: var(--dark);
            border-radius: 9999px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            background: white;
            transition: border-color 0.25s, background 0.25s;
        }
        .btn-secondary:hover { border-color: var(--brown); background: var(--light); }

        /* ── FEATURES ── */
        .features {
            padding: 5rem 10%;
            text-align: center;
        }
        .features-eyebrow {
            color: var(--brown);
            font-size: 0.72rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            font-weight: 500;
        }
        .features h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            margin: 0.75rem 0 3rem;
            color: var(--dark);
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }
        .feature-card {
            background: white;
            border-radius: 1.25rem;
            padding: 2rem 1.5rem;
            text-align: left;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: box-shadow 0.3s, transform 0.3s;
        }
        .feature-card:hover { box-shadow: 0 12px 32px rgba(0,0,0,0.09); transform: translateY(-4px); }
        .feature-icon {
            width: 3rem; height: 3rem;
            background: var(--light);
            border-radius: 0.75rem;
            display: flex; align-items: center; justify-content: center;
            color: var(--brown);
            margin-bottom: 1.25rem;
        }
        .feature-card h3 { font-size: 1.05rem; color: var(--dark); margin-bottom: 0.5rem; font-weight: 600; }
        .feature-card p { font-size: 0.875rem; color: rgba(45,36,36,0.6); line-height: 1.65; }

        /* ── ABOUT ── */
        .about {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            padding: 5rem 10%;
            background: rgba(245,230,211,0.25);
        }
        @media (max-width: 800px) { .about { grid-template-columns: 1fr; } }

        .about-image { position: relative; }
        .about-image img {
            width: 100%;
            border-radius: 1.5rem;
            object-fit: cover;
            aspect-ratio: 4/3;
        }
        .rating-badge {
            position: absolute;
            bottom: -1rem; right: -1rem;
            background: white;
            border-radius: 1rem;
            padding: 0.9rem 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        .rating-badge strong { font-size: 1.2rem; color: var(--dark); display: block; line-height: 1; }
        .rating-badge small { font-size: 0.72rem; color: rgba(45,36,36,0.5); }

        .about-eyebrow { color: var(--brown); font-size: 0.72rem; letter-spacing: 0.25em; text-transform: uppercase; font-weight: 500; }
        .about h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            margin: 0.75rem 0 1rem;
            color: var(--dark);
        }
        .about > div > p { font-size: 0.95rem; color: rgba(45,36,36,0.65); line-height: 1.75; margin-bottom: 2rem; }

        .stats-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
        .stat-item {
            background: white;
            border-radius: 1rem;
            padding: 1.25rem;
        }
        .stat-item h3 { font-family: 'Playfair Display', serif; font-size: 1.8rem; color: var(--brown); margin-bottom: 0.25rem; }
        .stat-item p { font-size: 0.8rem; color: rgba(45,36,36,0.6); }

        /* ── CLASSES ── */
        .classes { padding: 5rem 10%; }
        .classes-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2.5rem;
        }
        .classes-header-left small { color: var(--brown); font-size: 0.72rem; letter-spacing: 0.25em; text-transform: uppercase; font-weight: 500; }
        .classes-header-left h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            color: var(--dark);
            margin-top: 0.5rem;
        }
        .classes-header a { color: var(--brown); text-decoration: none; font-size: 0.9rem; transition: opacity 0.2s; }
        .classes-header a:hover { opacity: 0.7; }

        .class-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1.5rem; }
        .class-card {
            background: white;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            transition: box-shadow 0.3s, transform 0.3s;
        }
        .class-card:hover { box-shadow: 0 16px 40px rgba(0,0,0,0.1); transform: translateY(-4px); }
        .class-img {
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .prof-tag {
            position: absolute;
            bottom: 0.75rem; left: 0.75rem;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(6px);
            font-size: 0.7rem;
            font-weight: 500;
            padding: 0.3rem 0.75rem;
            border-radius: 9999px;
            color: var(--dark);
        }
        .class-info {
            padding: 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .class-info h3 { font-family: 'Playfair Display', serif; font-size: 1.1rem; color: var(--dark); margin-bottom: 0.2rem; }
        .class-info small { font-size: 0.78rem; color: rgba(45,36,36,0.5); display: flex; align-items: center; gap: 0.3rem; }
        .class-price { font-weight: 600; font-size: 1.15rem; color: var(--brown); }

        /* ── CTA BANNER ── */
        .cta-banner {
            text-align: center;
            padding: 5rem 10%;
            background: var(--dark);
        }
        .cta-banner h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            color: white;
            margin-bottom: 1rem;
        }
        .cta-banner p { color: rgba(255,255,255,0.6); font-size: 1rem; margin-bottom: 2rem; }
        .cta-banner .btn-primary { margin: 0 auto; }

        /* ── FOOTER ── */
        footer {
            background: var(--dark2);
            color: rgba(255,255,255,0.5);
            padding: 3rem 2.5rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.06);
        }
        .footer-grid {
            max-width: 72rem;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 2.5rem;
            padding-bottom: 2.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        @media (max-width: 768px) { .footer-grid { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 480px) { .footer-grid { grid-template-columns: 1fr; } }

        .footer-col p { font-size: 0.85rem; line-height: 1.7; margin-top: 0.5rem; }
        .footer-col h4 {
            font-size: 0.7rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
            margin-bottom: 1rem;
            font-weight: 500;
        }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 0.6rem; }
        .footer-col ul li { font-size: 0.85rem; }
        .footer-col ul li a { color: rgba(255,255,255,0.5); text-decoration: none; transition: color 0.2s; }
        .footer-col ul li a:hover { color: white; }

        .footer-logo { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem; }
        .footer-logo-icon {
            width: 2.2rem; height: 2.2rem;
            background: var(--brown);
            border-radius: 0.5rem;
            display: flex; align-items: center; justify-content: center;
            color: white;
        }
        .footer-logo strong { font-family: 'Playfair Display', serif; color: white; font-size: 1.1rem; }

        .social-icons { display: flex; gap: 0.75rem; margin-top: 0.5rem; }
        .social-icons a {
            width: 2.2rem; height: 2.2rem;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            transition: background 0.25s, color 0.25s;
        }
        .social-icons a:hover { background: var(--brown); color: white; }

        .copyright {
            max-width: 72rem;
            margin: 1.5rem auto 0;
            font-size: 0.8rem;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header>
    <a href="home.php" class="logo">
        <div class="logo-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
        </div>
        <div>
            <strong><?= $nombreEstudio ?></strong>
            <small>Estudio de Artes Musicales</small>
        </div>
    </a>
    <nav>
        <ul>
            <li><a href="home.php" class="active">Inicio</a></li>
            <li><a href="clases.php">Clases</a></li>
            <li><a href="eventos.php">Eventos</a></li>
            <li><a href="contacto.php">Contacto</a></li>
        </ul>
    </nav>
    <a href="clases.php" class="btn-reserva">RESERVAR CLASE</a>
</header>

<!-- HERO -->
<section class="hero">
    <span class="hero-eyebrow">Bienvenido a Pizzicato</span>
    <h1>Estudio de <br><span>Artes Musicales</span></h1>
    <p>Descubre tu talento musical con nosotros. Clases personalizadas de piano, guitarra, canto y más instrumentos.</p>
    <div class="hero-btns">
        <a href="clases.php" class="btn-primary">
            VER CLASES
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
        <a href="contacto.php" class="btn-secondary">CONTACTAR</a>
    </div>
</section>

<!-- FEATURES -->
<section class="features">
    <span class="features-eyebrow">Por qué elegirnos</span>
    <h2>Tu escuela de artes musicales</h2>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
            </div>
            <h3>Variedad de Instrumentos</h3>
            <p>Piano, guitarra, canto, violín y más. Encuentra el instrumento perfecto para ti.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <h3>Profesores Expertos</h3>
            <p>Aprende con músicos profesionales con años de experiencia en la enseñanza.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
            </div>
            <h3>Todos los Niveles</h3>
            <p>Desde principiantes hasta avanzados. Adaptamos las clases a tu nivel.</p>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="about">
    <div class="about-image">
        <img src="https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800" alt="Estudio Pizzicato">
        <div class="rating-badge">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="var(--brown)" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <div><strong>4.9</strong><small>Valoración</small></div>
        </div>
    </div>
    <div>
        <span class="about-eyebrow">Sobre nosotros</span>
        <h2>Más de 10 años formando músicos</h2>
        <p>En Pizzicato creemos que la música es un lenguaje universal que todos pueden aprender. Nuestra misión es proporcionar educación musical de calidad en un ambiente acogedor y profesional.</p>
        <div class="stats-grid">
            <div class="stat-item"><h3>10+</h3><p>Años de experiencia</p></div>
            <div class="stat-item"><h3>30+</h3><p>Alumnos activos</p></div>
            <div class="stat-item"><h3>1</h3><p>Profesor</p></div>
            <div class="stat-item"><h3>10+</h3><p>Clases semanales</p></div>
        </div>
    </div>
</section>

<!-- CLASSES -->
<section class="classes">
    <div class="classes-header">
        <div class="classes-header-left">
            <small>Nuestras clases</small>
            <h2>Encuentra tu instrumento</h2>
        </div>
        <a href="clases.php">Ver todas las clases →</a>
    </div>
    <div class="class-grid">
        <div class="class-card">
            <div class="class-img" style="background-image: url('https://images.unsplash.com/photo-1520522118941-d46427870f4d?auto=format&fit=crop&q=80&w=500');">
                <span class="prof-tag">PROF. Jhonathan Catalan</span>
            </div>
            <div class="class-info">
                <div>
                    <h3>Piano</h3>
                    <small>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        50 min
                    </small>
                </div>
                <span class="class-price">$800</span>
            </div>
        </div>
        <div class="class-card">
            <div class="class-img" style="background-image: url('https://images.unsplash.com/photo-1525201548942-d8732f6617a0?auto=format&fit=crop&q=80&w=500');">
                <span class="prof-tag">PROF. Jhonathan Catalan</span>
            </div>
            <div class="class-info">
                <div>
                    <h3>Guitarra</h3>
                    <small>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        50 min
                    </small>
                </div>
                <span class="class-price">$800</span>
            </div>
        </div>
        <div class="class-card">
            <div class="class-img" style="background-image: url('https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&q=80&w=500');">
                <span class="prof-tag">PROF. Jhonathan Catalan</span>
            </div>
            <div class="class-info">
                <div>
                    <h3>Canto</h3>
                    <small>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        50 min
                    </small>
                </div>
                <span class="class-price">$800</span>
            </div>
        </div>
    </div>
</section>

<!-- CTA BANNER -->
<section class="cta-banner">
    <h2>¿Listo para comenzar?</h2>
    <p>Reserva tu primera clase y descubre tu potencial musical.</p>
    <a href="clases.php" class="btn-primary">
        Reservar Clase
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
    </a>
</section>

<!-- FOOTER -->
<footer>
    <div class="footer-grid">
        <div class="footer-col">
            <div class="footer-logo">
                <div class="footer-logo-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
                </div>
                <strong><?= $nombreEstudio ?></strong>
            </div>
            <p>Descubre tu talento musical. Clases de piano, guitarra, canto y más.</p>
        </div>
        <div class="footer-col">
            <h4>Navegación</h4>
            <ul>
                <li><a href="home.php">Inicio</a></li>
                <li><a href="clases.php">Clases</a></li>
                <li><a href="eventos.php">Eventos</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Contacto</h4>
            <ul>
                <li>info@pizzicato.mx</li>
                <li>Av. 4 de Marzo &amp; Rtno. 7, Payo Obispo, 77083, Chetumal, Q.R.</li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Síguenos</h4>
            <div class="social-icons">
                <a href="#" aria-label="Instagram">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </a>
                <a href="#" aria-label="Facebook">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
            </div>
        </div>
    </div>
    <div class="copyright">
        &copy; <?= $anioActual ?> Estudio de Artes Musicales <?= $nombreEstudio ?>. Todos los derechos reservados.
    </div>
</footer>

</body>
</html>