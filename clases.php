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

        /* ── HAMBURGER ── */
        .hamburger { display: none; flex-direction: column; justify-content: center; gap: 5px; background: none; border: none; cursor: pointer; padding: 0.4rem; z-index: 200; }
        .hamburger span { display: block; width: 22px; height: 2px; background: var(--dark); border-radius: 2px; transition: transform 0.35s ease, opacity 0.25s ease; }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
        .mobile-nav { display: none; position: fixed; inset: 0; z-index: 150; background: rgba(45,36,36,0.45); backdrop-filter: blur(2px); opacity: 0; transition: opacity 0.3s ease; }
        .mobile-nav.open { opacity: 1; }
        .mobile-nav-panel { position: absolute; top: 0; right: 0; height: 100%; width: min(80vw, 320px); background: var(--cream); padding: 5rem 2rem 2rem; transform: translateX(100%); transition: transform 0.35s cubic-bezier(0.4,0,0.2,1); display: flex; flex-direction: column; gap: 0.25rem; }
        .mobile-nav.open .mobile-nav-panel { transform: translateX(0); }
        .mobile-nav-panel a { display: block; padding: 0.85rem 0; font-size: 1.05rem; color: var(--dark); text-decoration: none; border-bottom: 1px solid var(--light); transition: color 0.2s; }
        .mobile-nav-panel a:hover, .mobile-nav-panel a.active { color: var(--brown); }
        .mobile-nav-panel .mobile-reserva { margin-top: 1.5rem; display: block; text-align: center; padding: 0.85rem 1.4rem; background: var(--brown); color: white; border-radius: 9999px; text-decoration: none; font-weight: 500; font-size: 0.875rem; letter-spacing: 0.05em; border-bottom: none; }

        @media (max-width: 768px) {
            nav { display: none; }
            .btn-reserva { display: none; }
            .hamburger { display: flex; }
            header { padding: 1rem 1.25rem; }
        }

        /* ── HERO ── */
        .hero { padding: 6rem 8rem; background: rgba(245,230,211,0.3); }
        @media (max-width: 900px) { .hero { padding: 4rem 2rem; } }
        @media (max-width: 480px) { .hero { padding: 3rem 1.25rem; } }
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
        @media (max-width: 480px) { .grid-section { padding: 3rem 1.25rem; } }
        .grid-inner { max-width: 72rem; margin: 0 auto; }
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }
        @media (max-width: 640px) { .cards-grid { grid-template-columns: 1fr; } }

        /* ── SKELETON LOADER ── */
        .skeleton-card {
            background: white;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }
        .skeleton-img {
            aspect-ratio: 16/10;
            background: linear-gradient(90deg, var(--light) 25%, #efe0cc 50%, var(--light) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
        .skeleton-body { padding: 1.5rem; }
        .skeleton-line {
            height: 0.85rem;
            border-radius: 9999px;
            background: linear-gradient(90deg, var(--light) 25%, #efe0cc 50%, var(--light) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
            margin-bottom: 0.75rem;
        }
        .skeleton-line.short  { width: 40%; }
        .skeleton-line.medium { width: 65%; }
        .skeleton-line.long   { width: 90%; }
        .skeleton-line.title  { height: 1.2rem; width: 75%; margin-bottom: 1rem; }
        @keyframes shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

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
        .badge-todos        { background: var(--brown); }
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

        /* ── ERROR ── */
        .error-banner {
            display: none;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            color: #dc2626;
            font-size: 0.9rem;
            align-items: center;
            gap: 0.75rem;
        }
        .error-banner.show { display: flex; }
        .error-banner button {
            margin-left: auto;
            background: var(--brown);
            color: white;
            border: none;
            border-radius: 9999px;
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
        }

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
    <button class="hamburger" id="hamburgerBtn" aria-label="Abrir menú" aria-expanded="false">
        <span></span><span></span><span></span>
    </button>

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

<!-- MOBILE NAV -->
<div class="mobile-nav" id="mobileNav" role="dialog" aria-modal="true" aria-label="Menú de navegación">
    <div class="mobile-nav-panel">
        <a href="home.php">Inicio</a>
        <a href="clases.php" class="active">Clases</a>
        <a href="eventos.php">Eventos</a>
        <a href="contacto.php">Contacto</a>
        <a href="clases.php" class="mobile-reserva">RESERVAR CLASE</a>
    </div>
</div>
<script>
(function(){
    const btn = document.getElementById('hamburgerBtn');
    const nav = document.getElementById('mobileNav');
    function openMenu() { nav.style.display='block'; requestAnimationFrame(()=>nav.classList.add('open')); btn.classList.add('open'); btn.setAttribute('aria-expanded','true'); document.body.style.overflow='hidden'; }
    function closeMenu() { nav.classList.remove('open'); btn.classList.remove('open'); btn.setAttribute('aria-expanded','false'); document.body.style.overflow=''; setTimeout(()=>{nav.style.display='none';},350); }
    btn.addEventListener('click', () => btn.classList.contains('open') ? closeMenu() : openMenu());
    nav.addEventListener('click', e => { if (e.target === nav) closeMenu(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });
})();
</script>

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
            <!-- Se populan dinámicamente desde la API -->
            <button class="pill active" data-instrument="todos">Todos</button>
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
        <div class="error-banner" id="errorBanner">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span id="errorMsg">No se pudieron cargar las clases.</span>
            <button onclick="cargarClases()">Reintentar</button>
        </div>
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
// ── Configuración ─────────────────────────────────────────
const API_URL = 'api/clases.php';

// ── Estado ────────────────────────────────────────────────
let todasLasClases   = [];
let activeInstrumento = 'todos';
let activeLevel       = 'todos';

// ── SVG helpers ───────────────────────────────────────────
const clockSVG  = `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>`;
const arrowSVG  = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>`;
const musicSVG  = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>`;

const levelLabels = {
    principiante: 'Principiante',
    intermedio:   'Intermedio',
    avanzado:     'Avanzado',
    todos:        'Todos los niveles'
};

// ── Capitalizar ───────────────────────────────────────────
function cap(str) {
    if (!str) return '';
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// ── Formatear horario desde la API ────────────────────────
// La API devuelve { dia_semana: "lunes", hora: "10:00:00" }
// Mostramos: "Lunes 10:00"
function formatHorario(h) {
    const hora = h.hora ? h.hora.substring(0, 5) : '';
    return `${cap(h.dia_semana)} ${hora}`;
}

// ── Skeleton loaders ──────────────────────────────────────
function mostrarSkeletons(n = 6) {
    const grid = document.getElementById('cardsGrid');
    grid.style.display = 'grid';
    grid.innerHTML = Array.from({ length: n }, () => `
        <div class="skeleton-card">
            <div class="skeleton-img"></div>
            <div class="skeleton-body">
                <div class="skeleton-line short"></div>
                <div class="skeleton-line title"></div>
                <div class="skeleton-line long"></div>
                <div class="skeleton-line medium"></div>
            </div>
        </div>`).join('');
}

// ── Cargar clases desde la API ────────────────────────────
async function cargarClases() {
    const errorBanner = document.getElementById('errorBanner');
    errorBanner.classList.remove('show');
    mostrarSkeletons();

    try {
        const res = await fetch(API_URL);
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const data = await res.json();

        if (data.error) throw new Error(data.error);

        todasLasClases = data;
        construirPills();
        render();
    } catch (err) {
        console.error('Error cargando clases:', err);
        document.getElementById('cardsGrid').innerHTML = '';
        document.getElementById('cardsGrid').style.display = 'none';
        document.getElementById('errorMsg').textContent =
            'No se pudieron cargar las clases. Verifica tu conexión.';
        errorBanner.classList.add('show');
    }
}

// ── Construir pills de instrumentos dinámicamente ─────────
function construirPills() {
    const instrumentos = [...new Set(
        todasLasClases
            .map(c => c.instrumento)
            .filter(Boolean)
    )].sort();

    const container = document.getElementById('instrumentPills');
    container.innerHTML = `<button class="pill active" data-instrument="todos">Todos</button>`;

    instrumentos.forEach(inst => {
        const btn = document.createElement('button');
        btn.className = 'pill';
        btn.dataset.instrument = inst;
        btn.textContent = cap(inst);
        container.appendChild(btn);
    });
}

// ── Renderizar tarjetas ───────────────────────────────────
function render() {
    const grid  = document.getElementById('cardsGrid');
    const empty = document.getElementById('emptyState');

    const filtered = todasLasClases.filter(c => {
        const iMatch = activeInstrumento === 'todos' || c.instrumento === activeInstrumento;
        const lMatch = activeLevel === 'todos' || c.nivel === activeLevel || c.nivel === 'todos';
        return iMatch && lMatch && c.estado === 'activa';
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
        const horarios = Array.isArray(clase.horarios) ? clase.horarios : [];
        const shown = horarios.slice(0, 2);
        const extra = horarios.length - 2;

        const imgSrc = clase.imagen_url
            ? clase.imagen_url
            : `https://images.unsplash.com/photo-1520523839897-bd0b52f945a0?w=600&q=80`;

        const card = document.createElement('div');
        card.className = 'card';
        card.style.animationDelay = `${i * 0.05}s`;
        card.innerHTML = `
            <div class="card-img-wrap">
                <img src="${imgSrc}" alt="${clase.nombre}" loading="lazy"
                     onerror="this.src='https://images.unsplash.com/photo-1520523839897-bd0b52f945a0?w=600&q=80'">
                <span class="badge badge-${clase.nivel}">${levelLabels[clase.nivel] ?? cap(clase.nivel)}</span>
            </div>
            <div class="card-body">
                <div class="card-meta">
                    ${musicSVG}
                    <span>${cap(clase.instrumento)}</span>
                    <span class="dot"></span>
                    <span>${clase.profesor ?? ''}</span>
                </div>
                <h3 class="card-title">${clase.nombre}</h3>
                <p class="card-desc">${clase.descripcion ?? ''}</p>
                ${horarios.length > 0 ? `
                    <div class="horarios-label">Horarios</div>
                    ${shown.map(h => `<div class="horario-item">${clockSVG} ${formatHorario(h)}</div>`).join('')}
                    ${extra > 0 ? `<div class="more-horarios">+${extra} más</div>` : ''}
                ` : ''}
                <div class="card-footer">
                    <div class="card-footer-left">
                        <div style="display:flex;align-items:center;gap:4px">${clockSVG} <span>${clase.duracion ?? 60} min</span></div>
                        <span class="card-price">$${Number(clase.precio ?? 0).toLocaleString('es-MX')}</span>
                    </div>
                    <a href="reserva.php?clase=${clase.id}" class="card-link">Reservar ${arrowSVG}</a>
                </div>
            </div>`;
        grid.appendChild(card);
    });
}

// ── Limpiar filtros ───────────────────────────────────────
function clearFilters() {
    activeInstrumento = 'todos';
    activeLevel = 'todos';
    document.getElementById('levelSelect').value = 'todos';
    document.querySelectorAll('.pill').forEach(p =>
        p.classList.toggle('active', p.dataset.instrument === 'todos'));
    render();
}

// ── Eventos ───────────────────────────────────────────────
document.getElementById('instrumentPills').addEventListener('click', e => {
    const pill = e.target.closest('.pill');
    if (!pill) return;
    activeInstrumento = pill.dataset.instrument;
    document.querySelectorAll('.pill').forEach(p => p.classList.toggle('active', p === pill));
    render();
});

document.getElementById('levelSelect').addEventListener('change', e => {
    activeLevel = e.target.value;
    render();
});

// ── Inicio ────────────────────────────────────────────────
cargarClases();
</script>
</body>
</html>