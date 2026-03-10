<?php
$nombreEstudio = "Pizzicato";
$anioActual = date("Y");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos | Pizzicato - Estudio de Artes Musicales</title>
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
            position: relative;
            min-height: 70vh;
            display: flex;
            align-items: flex-end;
        }
        .hero-bg { position: absolute; inset: 0; }
        .hero-bg img { width: 100%; height: 100%; object-fit: cover; }
        .hero-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, #2D2424 0%, rgba(45,36,36,0.5) 50%, transparent 100%);
        }
        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 72rem;
            margin: 0 auto;
            padding: 5rem 2rem;
            width: 100%;
        }
        .hero-inner { max-width: 36rem; }
        .badge-gold {
            display: inline-block;
            background: var(--gold);
            color: white;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.3rem 0.85rem;
            border-radius: 9999px;
            margin-bottom: 1rem;
            letter-spacing: 0.05em;
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            color: white;
            margin-bottom: 1rem;
            line-height: 1.1;
        }
        .hero p {
            color: rgba(255,255,255,0.8);
            font-size: 1.05rem;
            line-height: 1.75;
            margin-bottom: 1.5rem;
        }
        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 2rem;
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
        }
        .hero-meta-item { display: flex; align-items: center; gap: 0.5rem; }
        .hero-entry {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: rgba(255,255,255,0.9);
        }

        /* ── FILTERS ── */
        .filters {
            position: sticky;
            top: 65px;
            z-index: 40;
            background: var(--cream);
            border-bottom: 1px solid var(--light);
            padding: 1rem 2rem;
        }
        .filters-inner {
            max-width: 72rem;
            margin: 0 auto;
            display: flex;
            gap: 0.5rem;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .filters-inner::-webkit-scrollbar { display: none; }
        .pill {
            padding: 0.6rem 1.25rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            white-space: nowrap;
            border: none;
            cursor: pointer;
            background: white;
            color: rgba(45,36,36,0.7);
            transition: all 0.25s ease;
            font-family: 'DM Sans', sans-serif;
        }
        .pill:hover { background: var(--light); }
        .pill.active { background: var(--brown); color: white; }

        /* ── EVENT SECTIONS ── */
        .eventos-section { padding: 4rem 2rem; }
        .eventos-section.bg-light { background: rgba(245,230,211,0.3); }
        .section-inner { max-width: 72rem; margin: 0 auto; }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
        }
        .section-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem;
            color: var(--dark);
        }
        .section-header p { color: rgba(45,36,36,0.6); margin-top: 0.25rem; font-size: 0.9rem; }
        .section-count { color: rgba(45,36,36,0.6); font-size: 0.9rem; padding-top: 0.25rem; }

        /* ── GRID ── */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
            gap: 2rem;
        }

        /* ── CARD ── */
        @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        .card {
            background: white;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            transition: box-shadow 0.4s ease, transform 0.4s ease;
            opacity: 0;
            animation: fadeUp 0.4s ease forwards;
        }
        .card:hover { box-shadow: 0 20px 50px rgba(0,0,0,0.12); transform: translateY(-4px); }
        .card:nth-child(1) { animation-delay: 0s; }
        .card:nth-child(2) { animation-delay: 0.05s; }
        .card:nth-child(3) { animation-delay: 0.1s; }

        .card-img-wrap { aspect-ratio: 16/10; overflow: hidden; position: relative; }
        .card-img-wrap img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .card:hover .card-img-wrap img { transform: scale(1.05); }

        .date-badge {
            position: absolute;
            top: 1rem; right: 1rem;
            background: white;
            border-radius: 0.75rem;
            padding: 0.6rem 0.75rem;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .date-badge-day {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--brown);
            line-height: 1;
        }
        .date-badge-month { font-size: 0.65rem; color: rgba(45,36,36,0.6); text-transform: uppercase; letter-spacing: 0.05em; }

        .card-img-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 60%);
        }
        .card-img-date { position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem; }
        .badge-date {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            backdrop-filter: blur(4px);
        }

        .card-body { padding: 1.5rem; }
        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            color: var(--dark);
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .card-desc {
            font-size: 0.85rem;
            color: rgba(45,36,36,0.6);
            line-height: 1.6;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .card-info { display: flex; flex-direction: column; gap: 0.4rem; }
        .card-info-item { display: flex; align-items: center; gap: 0.4rem; font-size: 0.85rem; color: rgba(45,36,36,0.6); }

        .photos-label {
            font-size: 0.7rem;
            color: var(--brown);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin: 1rem 0 0.5rem;
        }
        .photos-strip { display: flex; gap: 0.5rem; }
        .photo-thumb { flex: 1; aspect-ratio: 1; border-radius: 0.5rem; overflow: hidden; }
        .photo-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
        .photo-thumb img:hover { transform: scale(1.1); }

        /* ── CTA ── */
        .cta-section { padding: 6rem 2rem; background: var(--dark); text-align: center; }
        .cta-icon {
            width: 4rem; height: 4rem;
            background: var(--brown);
            border-radius: 9999px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem;
        }
        .cta-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            color: white;
            margin-bottom: 1rem;
        }
        .cta-section p {
            color: rgba(255,255,255,0.6);
            font-size: 1.05rem;
            max-width: 36rem;
            margin: 0 auto 2rem;
            line-height: 1.75;
        }
        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1.1rem 2.5rem;
            background: var(--brown);
            color: white;
            border-radius: 9999px;
            text-decoration: none;
            font-size: 1rem;
            font-family: 'DM Sans', sans-serif;
            transition: background 0.3s ease;
        }
        .cta-btn:hover { background: #6B3410; }

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

        .hidden { display: none !important; }
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
            <li><a href="home.php">Inicio</a></li>
            <li><a href="clases.php">Clases</a></li>
            <li><a href="eventos.php" class="active">Eventos</a></li>
            <li><a href="contacto.php">Contacto</a></li>
        </ul>
    </nav>
    <a href="clases.php" class="btn-reserva">RESERVAR CLASE</a>
</header>

<!-- HERO -->
<section class="hero">
    <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1511735111819-9a3f7709049c?w=800&q=80" alt="Día del Amor y la Amistad">
    </div>
    <div class="hero-content">
        <div class="hero-inner">
            <span class="badge-gold">Evento Destacado</span>
            <h1>Día del Amor y la Amistad</h1>
            <p>Concierto especial con piezas románticas interpretadas por nuestros alumnos. Entrada libre.</p>
            <div class="hero-meta">
                <div class="hero-meta-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <span>14 de febrero, 2026</span>
                </div>
                <div class="hero-meta-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <span>19:00</span>
                </div>
                <div class="hero-meta-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>Auditorio Pizzicato</span>
                </div>
            </div>
            <span class="hero-entry">Entrada libre</span>
        </div>
    </div>
</section>

<!-- FILTERS -->
<section class="filters">
    <div class="filters-inner">
        <button class="pill active" data-filter="todos">Todos</button>
        <button class="pill" data-filter="proximo">Próximos</button>
        <button class="pill" data-filter="pasado">Anteriores</button>
    </div>
</section>

<!-- PRÓXIMOS EVENTOS -->
<section class="eventos-section" id="proximosSection">
    <div class="section-inner">
        <div class="section-header">
            <div>
                <h2>Próximos Eventos</h2>
                <p>No te pierdas nuestras presentaciones</p>
            </div>
            <span class="section-count">3 eventos</span>
        </div>
        <div class="cards-grid" id="proximosGrid"></div>
    </div>
</section>

<!-- EVENTOS PASADOS -->
<section class="eventos-section bg-light" id="pasadosSection">
    <div class="section-inner">
        <div class="section-header">
            <div>
                <h2>Eventos Anteriores</h2>
                <p>Revive nuestros momentos especiales</p>
            </div>
            <span class="section-count">3 eventos</span>
        </div>
        <div class="cards-grid" id="pasadosGrid"></div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="cta-icon">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
    </div>
    <h2>¿Quieres participar?</h2>
    <p>Nuestros alumnos tienen la oportunidad de presentarse en recitales y eventos especiales. ¡Únete y comparte tu talento!</p>
    <a href="clases.php" class="cta-btn">
        Ver Clases
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
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
                <li>estudiopizzicato@gmail.com</li>
                <li>Av. 4 de Marzo & Rtno. 7, Payo Obispo, 77083 Chetumal, Q.R.</li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Síguenos</h4>
            <div class="social-icons">
                <a href="#" aria-label="Instagram">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </a>
                <a href="https://www.facebook.com/EDAMPizzicato" aria-label="Facebook">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
            </div>
        </div>
    </div>
    <div class="copyright">
        &copy; <?= $anioActual ?> Estudio de Artes Musicales <?= $nombreEstudio ?>. Todos los derechos reservados.
    </div>
</footer>

<script>
const MONTHS_ES      = ['ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic'];
const MONTHS_FULL_ES = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];

const eventos = [
    { id:1, titulo:'Día del Amor y la Amistad', descripcion:'Concierto especial con piezas románticas interpretadas por nuestros alumnos. Entrada libre.', fecha:'2026-02-14', hora:'19:00', ubicacion:'Auditorio Pizzicato', imagen_url:'https://images.unsplash.com/photo-1511735111819-9a3f7709049c?w=800&q=80', tipo:'proximo', fotos:[] },
    { id:2, titulo:'Recital de Piano', descripcion:'Nuestros estudiantes de piano presentarán piezas clásicas y contemporáneas.', fecha:'2026-03-15', hora:'18:00', ubicacion:'Sala Principal Pizzicato', imagen_url:'https://images.unsplash.com/photo-1520523839897-bd0b52f945a0?w=800&q=80', tipo:'proximo', fotos:[] },
    { id:3, titulo:'Taller de Improvisación Jazz', descripcion:'Taller abierto para estudiantes avanzados con el maestro Carlos Ramírez.', fecha:'2026-04-20', hora:'16:00', ubicacion:'Estudio Pizzicato', imagen_url:'https://images.unsplash.com/photo-1415201364774-f6f0bb35f28f?w=800&q=80', tipo:'proximo', fotos:[] },
    { id:4, titulo:'Exposición de Explana', descripcion:'Muestra de arte y música con presentaciones de nuestros alumnos y artistas invitados.', fecha:'2025-11-13', hora:'17:00', ubicacion:'Galería Cultural', imagen_url:'https://images.unsplash.com/photo-1508700929628-666bc8bd84ea?w=800&q=80', tipo:'pasado', fotos:['https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=400&q=80','https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?w=400&q=80','https://images.unsplash.com/photo-1465847899084-d164df4dedc6?w=400&q=80'] },
    { id:5, titulo:'Concierto de Navidad', descripcion:'Presentación de fin de año con villancicos y piezas festivas.', fecha:'2025-12-20', hora:'19:30', ubicacion:'Teatro Municipal', imagen_url:'https://images.unsplash.com/photo-1476842384041-a57a4f124e2e?w=800&q=80', tipo:'pasado', fotos:['https://images.unsplash.com/photo-1519683384663-39b6387657f3?w=400&q=80','https://images.unsplash.com/photo-1519167758481-83f29da8c19e?w=400&q=80'] },
    { id:6, titulo:'Recital de Guitarra Clásica', descripcion:'Estudiantes de guitarra presentaron piezas de Bach, Tárrega y Villa-Lobos.', fecha:'2025-10-05', hora:'18:00', ubicacion:'Sala Pizzicato', imagen_url:'https://images.unsplash.com/photo-1510915361894-db8b60106cb1?w=800&q=80', tipo:'pasado', fotos:['https://images.unsplash.com/photo-1564186763535-ebb21ef5277f?w=400&q=80'] }
];

const clockSVG = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>`;
const pinSVG   = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>`;

function formatDateShort(dateStr) {
    const d = new Date(dateStr + 'T00:00:00');
    return `${d.getDate()} ${MONTHS_ES[d.getMonth()]} ${d.getFullYear()}`;
}

function buildProximoCard(ev) {
    const d = new Date(ev.fecha + 'T00:00:00');
    return `
        <div class="card">
            <div class="card-img-wrap">
                <img src="${ev.imagen_url}" alt="${ev.titulo}" loading="lazy">
                <div class="date-badge">
                    <div class="date-badge-day">${d.getDate()}</div>
                    <div class="date-badge-month">${MONTHS_ES[d.getMonth()]}</div>
                </div>
            </div>
            <div class="card-body">
                <h3 class="card-title">${ev.titulo}</h3>
                <p class="card-desc">${ev.descripcion}</p>
                <div class="card-info">
                    <div class="card-info-item">${clockSVG} <span>${ev.hora}</span></div>
                    <div class="card-info-item">${pinSVG} <span>${ev.ubicacion}</span></div>
                </div>
            </div>
        </div>`;
}

function buildPasadoCard(ev) {
    const photosHTML = ev.fotos && ev.fotos.length > 0 ? `
        <div class="photos-label">Fotos del evento</div>
        <div class="photos-strip">
            ${ev.fotos.slice(0,3).map(f => `<div class="photo-thumb"><img src="${f}" alt="foto" loading="lazy"></div>`).join('')}
        </div>` : '';
    return `
        <div class="card">
            <div class="card-img-wrap">
                <img src="${ev.imagen_url}" alt="${ev.titulo}" loading="lazy">
                <div class="card-img-overlay"></div>
                <div class="card-img-date">
                    <span class="badge-date">${formatDateShort(ev.fecha)}</span>
                </div>
            </div>
            <div class="card-body">
                <h3 class="card-title">${ev.titulo}</h3>
                <p class="card-desc">${ev.descripcion}</p>
                ${photosHTML}
            </div>
        </div>`;
}

function render(filter) {
    const proxSection  = document.getElementById('proximosSection');
    const pasadSection = document.getElementById('pasadosSection');
    const proxGrid     = document.getElementById('proximosGrid');
    const pasadGrid    = document.getElementById('pasadosGrid');

    const showProx  = filter === 'todos' || filter === 'proximo';
    const showPasad = filter === 'todos' || filter === 'pasado';

    proxSection.classList.toggle('hidden', !showProx);
    pasadSection.classList.toggle('hidden', !showPasad);

    if (showProx)  proxGrid.innerHTML  = eventos.filter(e => e.tipo === 'proximo').map(buildProximoCard).join('');
    if (showPasad) pasadGrid.innerHTML = eventos.filter(e => e.tipo === 'pasado').map(buildPasadoCard).join('');
}

document.querySelector('.filters-inner').addEventListener('click', e => {
    if (!e.target.classList.contains('pill')) return;
    document.querySelectorAll('.pill').forEach(p => p.classList.toggle('active', p === e.target));
    render(e.target.dataset.filter);
});

render('todos');
</script>
</body>
</html>
