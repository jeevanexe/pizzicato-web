<?php
$nombreEstudio = "Pizzicato";
$anioActual = date("Y");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clases | Pizzicato - Estudio de Artes Musicales</title>
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
            padding: 6rem 8rem;
            background: rgba(245,230,211,0.3);
        }
        .hero-inner { max-width: 50rem; margin: 0; }
        .hero-eyebrow {
            color: var(--brown);
            font-size: 0.75rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            font-weight: 500;
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 6vw, 4rem);
            color: var(--dark);
            margin: 0.5rem 0;
            line-height: 1.1;
        }
        .hero p {
            font-size: 1.15rem;
            color: rgba(45,36,36,0.6);
            line-height: 1.75;
            max-width: 36rem;
            padding-bottom: 1rem;
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
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            justify-content: space-between;
        }
        .instrument-pills {
            display: flex;
            gap: 0.5rem;
            overflow-x: auto;
            scrollbar-width: none;
            padding-bottom: 4px;
        }
        .instrument-pills::-webkit-scrollbar { display: none; }
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

        .level-filter { display: flex; align-items: center; gap: 0.5rem; }
        .level-filter svg { color: rgba(45,36,36,0.4); }
        .level-select {
            background: white;
            border: 1px solid var(--light);
            border-radius: 9999px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            color: var(--dark);
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            outline: none;
        }
        .level-select:focus { box-shadow: 0 0 0 3px rgba(139,69,19,0.15); }

        /* ── GRID ── */
        .grid-section { padding: 4rem 2rem; }
        .grid-inner { max-width: 72rem; margin: 0 auto; }
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
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
        .card:hover {
            box-shadow: 0 20px 50px rgba(0,0,0,0.12);
            transform: translateY(-4px);
        }
        .card:nth-child(1) { animation-delay: 0s; }
        .card:nth-child(2) { animation-delay: 0.05s; }
        .card:nth-child(3) { animation-delay: 0.1s; }
        .card:nth-child(4) { animation-delay: 0.15s; }
        .card:nth-child(5) { animation-delay: 0.2s; }
        .card:nth-child(6) { animation-delay: 0.25s; }
        .card:nth-child(7) { animation-delay: 0.3s; }
        .card:nth-child(8) { animation-delay: 0.35s; }

        .card-img-wrap { aspect-ratio: 16/10; overflow: hidden; position: relative; }
        .card-img-wrap img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .card:hover .card-img-wrap img { transform: scale(1.05); }

        .badge {
            position: absolute;
            top: 1rem; left: 1rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            color: white;
        }
        .badge-todos       { background: var(--brown); }
        .badge-principiante { background: #22c55e; }
        .badge-intermedio   { background: #3b82f6; }
        .badge-avanzado     { background: #a855f7; }

        .card-body { padding: 1.5rem; }
        .card-meta {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: var(--brown);
            margin-bottom: 0.5rem;
            flex-wrap: wrap;
        }
        .card-meta .dot { width: 4px; height: 4px; border-radius: 50%; background: var(--brown); }
        .card-title { font-family: 'Playfair Display', serif; font-size: 1.2rem; color: var(--dark); margin-bottom: 0.5rem; }
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
        .horarios-label { font-size: 0.7rem; color: rgba(45,36,36,0.5); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.25rem; }
        .horario-item { display: flex; align-items: center; gap: 0.25rem; font-size: 0.85rem; color: rgba(45,36,36,0.7); margin-bottom: 0.15rem; }
        .more-horarios { font-size: 0.75rem; color: var(--brown); margin-top: 0.15rem; }
        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--light);
            padding-top: 1rem;
            margin-top: 1rem;
        }
        .card-footer-left { display: flex; align-items: center; gap: 1rem; font-size: 0.85rem; color: rgba(45,36,36,0.6); }
        .card-price { font-weight: 600; color: var(--brown); }
        .card-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--brown);
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: gap 0.2s ease;
        }
        .card-link:hover { gap: 0.75rem; }

        /* ── EMPTY ── */
        .empty { text-align: center; padding: 5rem 2rem; display: none; }
        .empty p { font-size: 1.1rem; color: rgba(45,36,36,0.6); }
        .empty button {
            margin-top: 1rem;
            color: var(--brown);
            background: none;
            border: none;
            cursor: pointer;
            text-decoration: underline;
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
        }

        /* ── INFO SECTION ── */
        .info-section { padding: 4rem 2rem; background: rgba(245,230,211,0.3); }
        .info-inner { max-width: 72rem; margin: 0 auto; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
        @media (max-width: 640px) { .info-grid { grid-template-columns: 1fr; } }

        .info-card { background: white; border-radius: 1rem; padding: 2rem; }
        .info-icon {
            width: 3rem; height: 3rem;
            border-radius: 0.75rem;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1rem;
        }
        .info-icon.brown { background: var(--brown); }
        .info-icon.gold  { background: var(--gold); }
        .info-card h3 { font-family: 'Playfair Display', serif; font-size: 1.35rem; color: var(--dark); margin-bottom: 0.75rem; }
        .info-card p { color: rgba(45,36,36,0.7); line-height: 1.7; font-size: 0.95rem; }

        /* ── FOOTER ── */
        footer {
            background: var(--dark2);
            color: rgba(255,255,255,0.5);
            padding: 3rem 2.5rem 1.5rem;
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
            <li><a href="home.php">Inicio</a></li>
            <li><a href="clases.php" class="active">Clases</a></li>
            <li><a href="eventos.php">Eventos</a></li>
            <li><a href="contacto.php">Contacto</a></li>
        </ul>
    </nav>
    <a href="#" class="btn-reserva">RESERVAR CLASE</a>
</header>

<!-- HERO -->
<section class="hero">
    <div class="hero-inner">
        <span class="hero-eyebrow">Explora</span>
        <h1>Nuestras Clases</h1>
        <p>Descubre una amplia variedad de clases diseñadas para todos los niveles. Encuentra el instrumento perfecto para ti y comienza tu viaje musical.</p>
    </div>
</section>

<!-- FILTERS -->
<section class="filters">
    <div class="filters-inner">
        <div class="instrument-pills" id="instrumentPills">
            <button class="pill active" data-instrument="todos">Todos</button>
            <button class="pill" data-instrument="piano">Piano</button>
            <button class="pill" data-instrument="guitarra">Guitarra</button>
            <button class="pill" data-instrument="canto">Canto</button>
            <button class="pill" data-instrument="ukulele">Ukulele</button>

        </div>
        <div class="level-filter">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
            </svg>
            <select class="level-select" id="levelSelect">
                <option value="todos">Todos los niveles</option>
                <option value="principiante">Principiante</option>
                <option value="intermedio">Intermedio</option>
                <option value="avanzado">Avanzado</option>
            </select>
        </div>
    </div>
</section>

<!-- GRID -->
<section class="grid-section">
    <div class="grid-inner">
        <div class="cards-grid" id="cardsGrid"></div>
        <div class="empty" id="emptyState">
            <p>No hay clases disponibles con estos filtros.</p>
            <button onclick="clearFilters()">Limpiar filtros</button>
        </div>
    </div>
</section>

<!-- INFO -->
<section class="info-section">
    <div class="info-inner">
        <div class="info-grid">
            <div class="info-card">
                <div class="info-icon brown">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                </div>
                <h3>Clases Personalizadas</h3>
                <p>Todas nuestras clases son individuales o en grupos reducidos para garantizar atención personalizada y un aprendizaje óptimo.</p>
            </div>
            <div class="info-card">
                <div class="info-icon gold">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>
                    </svg>
                </div>
                <h3>Equipamiento Profesional</h3>
                <p>Nuestras instalaciones cuentan con instrumentos de calidad profesional y salas acústicamente tratadas.</p>
            </div>
        </div>
    </div>
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
const clases = [
    { id:1, nombre:'Piano Clásico', descripcion:'Aprende piano desde los fundamentos hasta piezas clásicas complejas. Técnica, teoría y práctica.', profesor:'Prof. Jhonatan Catalan', duracion:60, nivel:'todos', instrumento:'piano', imagen_url:'https://images.unsplash.com/photo-1520523839897-bd0b52f945a0?w=600&q=80', precio:800, horarios:['Lunes 10:00','Miércoles 16:00','Viernes 18:00'] },
    { id:2, nombre:'Piano Jazz', descripcion:'Improvisación, acordes complejos y técnicas de jazz. Para estudiantes con experiencia previa.', profesor:'Prof. Jhonatan Catalan', duracion:60, nivel:'intermedio', instrumento:'piano', imagen_url:'https://images.unsplash.com/photo-1552422535-c45813c61732?w=600&q=80', precio:800, horarios:['Martes 17:00','Jueves 19:00'] },
    { id:3, nombre:'Guitarra Acústica', descripcion:'Desde acordes básicos hasta técnicas avanzadas de fingerpicking. Repertorio variado.', profesor:'Prof. Jhonatan Catalan', duracion:50, nivel:'principiante', instrumento:'guitarra', imagen_url:'https://images.unsplash.com/photo-1510915361894-db8b60106cb1?w=600&q=80', precio:800, horarios:['Lunes 15:00','Miércoles 17:00','Sábado 10:00'] },
    { id:4, nombre:'Guitarra Eléctrica', descripcion:'Rock, blues, metal y más. Técnicas de solo, riffs y uso de efectos.', profesor:'Prof. Jhonatan Catalan', duracion:50, nivel:'intermedio', instrumento:'guitarra', imagen_url:'https://images.unsplash.com/photo-1564186763535-ebb21ef5277f?w=600&q=80', precio:800, horarios:['Martes 16:00','Jueves 18:00','Sábado 14:00'] },
    { id:5, nombre:'Canto Lírico', descripcion:'Técnica vocal clásica, respiración, proyección y repertorio operístico.', profesor:'Prof. Jhonatan Catalan', duracion:45, nivel:'todos', instrumento:'canto', imagen_url:'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=600&q=80', precio:800, horarios:['Lunes 11:00','Miércoles 15:00','Viernes 17:00'] },
    { id:6, nombre:'Canto Popular', descripcion:'Pop, rock, jazz. Técnica moderna, micrófono y expresión escénica.', profesor:'Prof. Jhonatan Catalan', duracion:45, nivel:'todos', instrumento:'canto', imagen_url:'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=600&q=80', precio:800, horarios:['Martes 10:00','Jueves 16:00','Sábado 11:00'] },
    { id:7, nombre:'Ukulele para Principiantes', descripcion:'Aprende a tocar el ukulele desde cero. Acordes básicos, rasgueos y canciones sencillas.', profesor:'Prof. Jhonatan Catalan', duracion:30, nivel:'principiante', instrumento:'ukulele', imagen_url:'https://volcanovillagelodge.com/ukulele-history-in-hawaiian-culture', precio:600, horarios:['Lunes 14:00','Miércoles 14:00','Viernes 14:00'] },
    { id:8, nombre:'Ukulele Intermedio', descripcion:'Técnicas avanzadas de rasgueo, fingerpicking y repertorio más desafiante.', profesor:'Prof. Jhonatan Catalan', duracion:30, nivel:'intermedio', instrumento:'ukulele', imagen_url:'https://images.unsplash.com/photo-1508971344143-1c631e9cbbf0?w=600&q=80', precio:600, horarios:['Martes 14:00','Jueves 14:00','Sábado 14:00'] }
];

const levelLabels = { principiante:'Principiante', intermedio:'Intermedio', avanzado:'Avanzado', todos:'Todos los niveles' };
const clockSVG = `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>`;
const arrowSVG = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>`;
const musicSVG = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>`;

let activeInstrumento = 'todos';
let activeLevel = 'todos';

function render() {
    const grid  = document.getElementById('cardsGrid');
    const empty = document.getElementById('emptyState');
    const filtered = clases.filter(c => {
        const iMatch = activeInstrumento === 'todos' || c.instrumento === activeInstrumento;
        const lMatch = activeLevel === 'todos' || c.nivel === activeLevel || c.nivel === 'todos';
        return iMatch && lMatch;
    });

    grid.innerHTML = '';
    if (filtered.length === 0) {
        grid.style.display = 'none';
        empty.style.display = 'block';
        return;
    }
    grid.style.display = 'grid';
    empty.style.display = 'none';

    filtered.forEach((clase, i) => {
        const shown = clase.horarios.slice(0, 2);
        const extra = clase.horarios.length - 2;
        const card = document.createElement('div');
        card.className = 'card';
        card.style.animationDelay = `${i * 0.05}s`;
        card.innerHTML = `
            <div class="card-img-wrap">
                <img src="${clase.imagen_url}" alt="${clase.nombre}" loading="lazy">
                <span class="badge badge-${clase.nivel}">${levelLabels[clase.nivel]}</span>
            </div>
            <div class="card-body">
                <div class="card-meta">
                    ${musicSVG}
                    <span style="text-transform:capitalize">${clase.instrumento}</span>
                    <span class="dot"></span>
                    <span>${clase.profesor}</span>
                </div>
                <h3 class="card-title">${clase.nombre}</h3>
                <p class="card-desc">${clase.descripcion}</p>
                <div class="horarios-label">Horarios</div>
                ${shown.map(h => `<div class="horario-item">${clockSVG} ${h}</div>`).join('')}
                ${extra > 0 ? `<div class="more-horarios">+${extra} más</div>` : ''}
                <div class="card-footer">
                    <div class="card-footer-left">
                        <div style="display:flex;align-items:center;gap:4px">${clockSVG} <span>${clase.duracion} min</span></div>
                        <span class="card-price">$${clase.precio}</span>
                    </div>
                    <a href="reserva.php?clase=${clase.id}" class="card-link">Reservar ${arrowSVG}</a>
                </div>
            </div>`;
        grid.appendChild(card);
    });
}

function clearFilters() {
    activeInstrumento = 'todos';
    activeLevel = 'todos';
    document.getElementById('levelSelect').value = 'todos';
    document.querySelectorAll('.pill').forEach(p => p.classList.toggle('active', p.dataset.instrument === 'todos'));
    render();
}

document.getElementById('instrumentPills').addEventListener('click', e => {
    if (!e.target.classList.contains('pill')) return;
    activeInstrumento = e.target.dataset.instrument;
    document.querySelectorAll('.pill').forEach(p => p.classList.toggle('active', p === e.target));
    render();
});

document.getElementById('levelSelect').addEventListener('change', e => {
    activeLevel = e.target.value;
    render();
});

render();
</script>
</body>
</html>
