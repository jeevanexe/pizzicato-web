<?php
$nombreEstudio = "Pizzicato";
$anioActual = date("Y");
$claseIdParam = isset($_GET['clase']) ? intval($_GET['clase']) : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Clase | Pizzicato</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --brown: #8B4513;
            --dark:  #2D2424;
            --dark2: #2D2D2D;
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
            position: sticky; top: 0; z-index: 100;
            background: var(--cream);
            border-bottom: 1px solid var(--light);
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 2.5rem; gap: 1rem;
        }
        .logo { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; color: var(--dark); }
        .logo-icon {
            width: 2.5rem; height: 2.5rem; background: var(--brown);
            border-radius: 0.6rem; display: flex; align-items: center; justify-content: center; color: white;
        }
        .logo strong { font-family: 'Playfair Display', serif; font-size: 1.15rem; display: block; line-height: 1.1; }
        .logo small { font-size: 0.6rem; color: #777; }
        nav ul { list-style: none; display: flex; gap: 2rem; }
        nav ul li a { text-decoration: none; font-size: 0.9rem; color: rgba(45,36,36,0.7); transition: color 0.2s; }
        nav ul li a:hover, nav ul li a.active { color: var(--brown); }
        .btn-reserva {
            padding: 0.6rem 1.4rem; background: var(--brown); color: white;
            border-radius: 9999px; text-decoration: none; font-size: 0.8rem;
            font-weight: 500; letter-spacing: 0.05em; white-space: nowrap; transition: background 0.25s;
        }
        .btn-reserva:hover { background: #6B3410; }
        @media (max-width: 768px) { nav { display: none; } header { padding: 1rem 1.25rem; } }

        /* ── RESERVA MAIN ── */
        .reserva-wrap { max-width: 56rem; margin: 0 auto; padding: 3rem 1.5rem 6rem; }

        .back-link {
            display: inline-flex; align-items: center; gap: 0.4rem;
            color: rgba(45,36,36,0.55); font-size: 0.875rem; text-decoration: none;
            margin-bottom: 1.5rem; transition: color 0.2s;
        }
        .back-link:hover { color: var(--brown); }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 5vw, 3rem);
            color: var(--dark); margin-bottom: 2rem;
        }

        /* ── STEPPER ── */
        .stepper {
            display: flex; align-items: center; gap: 0;
            margin-bottom: 3rem;
        }
        .step-item { display: flex; align-items: center; gap: 0.6rem; }
        .step-num {
            width: 2rem; height: 2rem; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; font-weight: 600; flex-shrink: 0;
            transition: all 0.3s;
        }
        .step-num.done    { background: var(--brown); color: white; }
        .step-num.active  { background: var(--brown); color: white; }
        .step-num.pending { background: var(--light); color: rgba(45,36,36,0.4); }
        .step-label { font-size: 0.875rem; color: rgba(45,36,36,0.55); white-space: nowrap; }
        .step-label.active { color: var(--dark); font-weight: 500; }
        .step-line {
            flex: 1; height: 1px; background: var(--light);
            margin: 0 0.75rem; min-width: 2rem;
        }
        .step-line.done { background: var(--brown); }

        /* ── PANELS ── */
        .panel { display: none; }
        .panel.active { display: block; animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }

        .panel-title { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--dark); margin-bottom: 1.5rem; }

        /* ── STEP 1: Clase ── */
        .clases-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        @media (max-width: 600px) { .clases-grid { grid-template-columns: 1fr; } }

        .clase-card {
            display: flex; align-items: center; gap: 1rem;
            background: white; border-radius: 1rem; padding: 1rem;
            border: 2px solid transparent; cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
            position: relative;
        }
        .clase-card:hover { border-color: var(--light); box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
        .clase-card.selected { border-color: var(--brown); }
        .clase-card img { width: 4.5rem; height: 4.5rem; border-radius: 0.6rem; object-fit: cover; flex-shrink: 0; }
        .clase-card-info { flex: 1; }
        .clase-card-info h4 { font-weight: 600; font-size: 0.95rem; margin-bottom: 0.2rem; }
        .clase-card-info small { font-size: 0.78rem; color: rgba(45,36,36,0.55); display: block; }
        .clase-card-meta { font-size: 0.8rem; color: rgba(45,36,36,0.55); display: flex; gap: 0.6rem; margin-top: 0.35rem; align-items: center; }
        .clase-card-meta .price { color: var(--brown); font-weight: 600; }
        .check-icon {
            position: absolute; top: 0.75rem; right: 0.75rem;
            width: 1.4rem; height: 1.4rem; border-radius: 50%;
            background: var(--brown); color: white;
            display: none; align-items: center; justify-content: center;
        }
        .clase-card.selected .check-icon { display: flex; }

        /* ── STEP 2: Fecha ── */
        .fecha-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
        @media (max-width: 600px) { .fecha-grid { grid-template-columns: 1fr; } }

        .calendar-wrap { background: white; border-radius: 1rem; padding: 1.5rem; }
        .cal-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; }
        .cal-header h4 { font-family: 'Playfair Display', serif; font-size: 1rem; }
        .cal-nav { background: none; border: none; cursor: pointer; color: rgba(45,36,36,0.5); padding: 0.25rem; border-radius: 4px; transition: color 0.2s; }
        .cal-nav:hover { color: var(--brown); }
        .cal-days-header { display: grid; grid-template-columns: repeat(7, 1fr); text-align: center; font-size: 0.7rem; color: rgba(45,36,36,0.4); margin-bottom: 0.5rem; }
        .cal-days { display: grid; grid-template-columns: repeat(7, 1fr); gap: 2px; }
        .cal-day {
            aspect-ratio: 1; display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; border-radius: 50%; cursor: pointer; transition: all 0.15s;
            color: rgba(45,36,36,0.7);
        }
        .cal-day.empty { pointer-events: none; }
        .cal-day.past { color: rgba(45,36,36,0.2); pointer-events: none; }
        .cal-day:not(.empty):not(.past):hover { background: var(--light); }
        .cal-day.selected { background: var(--brown); color: white; }
        .cal-day.today { font-weight: 700; }

        .horarios-wrap { background: white; border-radius: 1rem; padding: 1.5rem; }
        .horarios-wrap h4 { font-family: 'Playfair Display', serif; font-size: 1rem; margin-bottom: 1rem; }
        .horario-slots { display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; }
        .slot {
            padding: 0.6rem 0.75rem; border-radius: 0.6rem;
            border: 1px solid var(--light); background: white;
            font-size: 0.85rem; cursor: pointer; text-align: center;
            transition: all 0.2s; color: var(--dark);
        }
        .slot:hover { border-color: var(--brown); color: var(--brown); }
        .slot.selected { background: var(--brown); border-color: var(--brown); color: white; }
        .slot.unavailable { opacity: 0.35; pointer-events: none; }
        .no-date-msg { color: rgba(45,36,36,0.4); font-size: 0.875rem; text-align: center; padding: 2rem 0; }

        /* ── STEP 3: Datos ── */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        @media (max-width: 600px) { .form-grid { grid-template-columns: 1fr; } }
        .form-group { display: flex; flex-direction: column; gap: 0.4rem; }
        .form-group.full { grid-column: 1 / -1; }
        .form-group label { font-size: 0.8rem; font-weight: 500; color: rgba(45,36,36,0.6); text-transform: uppercase; letter-spacing: 0.08em; }
        .form-group input,
        .form-group select,
        .form-group textarea {
            background: white; border: 1px solid var(--light);
            border-radius: 0.75rem; padding: 0.75rem 1rem;
            font-size: 0.9rem; color: var(--dark); font-family: 'DM Sans', sans-serif;
            outline: none; transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--brown);
            box-shadow: 0 0 0 3px rgba(139,69,19,0.12);
        }
        .form-group textarea { resize: vertical; min-height: 5rem; }

        /* ── STEP 4: Confirmación ── */
        .confirm-card {
            background: white; border-radius: 1.25rem; padding: 2rem;
            max-width: 32rem; margin: 0 auto;
        }
        .confirm-success {
            text-align: center; margin-bottom: 2rem;
        }
        .confirm-check {
            width: 4rem; height: 4rem; background: #22c55e;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .confirm-success h3 { font-family: 'Playfair Display', serif; font-size: 1.5rem; margin-bottom: 0.4rem; }
        .confirm-success p { color: rgba(45,36,36,0.55); font-size: 0.9rem; }
        .confirm-details { display: flex; flex-direction: column; gap: 0.75rem; }
        .confirm-row { display: flex; justify-content: space-between; align-items: center; font-size: 0.9rem; }
        .confirm-row span:first-child { color: rgba(45,36,36,0.55); }
        .confirm-row span:last-child { font-weight: 500; }
        .confirm-divider { height: 1px; background: var(--light); margin: 0.5rem 0; }
        .confirm-total { font-weight: 600; font-size: 1rem; }
        .confirm-total span:last-child { color: var(--brown); font-size: 1.1rem; }
        .confirm-note {
            background: rgba(245,230,211,0.5); border-radius: 0.75rem;
            padding: 1rem; margin-top: 1.5rem; font-size: 0.82rem;
            color: rgba(45,36,36,0.6); line-height: 1.6;
        }

        /* ── BOTTOM NAV ── */
        .bottom-bar {
            position: sticky; bottom: 0; z-index: 50;
            background: var(--cream); border-top: 1px solid var(--light);
            padding: 1rem 2.5rem;
        }
        .bottom-inner {
            max-width: 56rem; margin: 0 auto;
            display: flex; align-items: center; justify-content: space-between;
        }
        .btn-back {
            display: flex; align-items: center; gap: 0.4rem;
            background: white; border: 1px solid var(--light);
            border-radius: 9999px; padding: 0.65rem 1.4rem;
            font-size: 0.875rem; font-family: 'DM Sans', sans-serif;
            cursor: pointer; color: rgba(45,36,36,0.7);
            transition: all 0.2s;
        }
        .btn-back:hover { border-color: var(--brown); color: var(--brown); }
        .btn-next {
            display: flex; align-items: center; gap: 0.4rem;
            background: var(--brown); color: white;
            border: none; border-radius: 9999px;
            padding: 0.75rem 2rem; font-size: 0.875rem; font-weight: 500;
            font-family: 'DM Sans', sans-serif; cursor: pointer;
            transition: background 0.2s; letter-spacing: 0.02em;
        }
        .btn-next:hover { background: #6B3410; }
        .btn-next:disabled { background: rgba(139,69,19,0.3); cursor: not-allowed; }
        .btn-next.hidden { display: none; }

        /* ── FOOTER ── */
        footer {
            background: var(--dark2); color: rgba(255,255,255,0.5);
            padding: 3rem 2.5rem 1.5rem;
        }
        .footer-grid {
            max-width: 72rem; margin: 0 auto;
            display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 2.5rem; padding-bottom: 2.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        @media (max-width: 768px) { .footer-grid { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 480px) { .footer-grid { grid-template-columns: 1fr; } }
        .footer-col p { font-size: 0.85rem; line-height: 1.7; margin-top: 0.5rem; }
        .footer-col h4 { font-size: 0.7rem; letter-spacing: 0.15em; text-transform: uppercase; color: rgba(255,255,255,0.4); margin-bottom: 1rem; font-weight: 500; }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 0.6rem; }
        .footer-col ul li { font-size: 0.85rem; }
        .footer-col ul li a { color: rgba(255,255,255,0.5); text-decoration: none; transition: color 0.2s; }
        .footer-col ul li a:hover { color: white; }
        .footer-logo { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem; }
        .footer-logo-icon { width: 2.2rem; height: 2.2rem; background: var(--brown); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; color: white; }
        .footer-logo strong { font-family: 'Playfair Display', serif; color: white; font-size: 1.1rem; }
        .social-icons { display: flex; gap: 0.75rem; margin-top: 0.5rem; }
        .social-icons a { width: 2.2rem; height: 2.2rem; background: rgba(255,255,255,0.08); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.5); text-decoration: none; transition: background 0.25s, color 0.25s; }
        .social-icons a:hover { background: var(--brown); color: white; }
        .copyright { max-width: 72rem; margin: 1.5rem auto 0; font-size: 0.8rem; text-align: center; }
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
    <a href="reserva.php" class="btn-reserva">RESERVAR CLASE</a>
</header>

<!-- MAIN -->
<main class="reserva-wrap">
    <a href="clases.php" class="back-link">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Volver a clases
    </a>

    <h1 class="page-title">Reservar Clase</h1>

    <!-- STEPPER -->
    <div class="stepper">
        <div class="step-item">
            <div class="step-num active" id="sn1">1</div>
            <span class="step-label active" id="sl1">Clase</span>
        </div>
        <div class="step-line" id="line1"></div>
        <div class="step-item">
            <div class="step-num pending" id="sn2">2</div>
            <span class="step-label" id="sl2">Fecha y Hora</span>
        </div>
        <div class="step-line" id="line2"></div>
        <div class="step-item">
            <div class="step-num pending" id="sn3">3</div>
            <span class="step-label" id="sl3">Tus Datos</span>
        </div>
        <div class="step-line" id="line3"></div>
        <div class="step-item">
            <div class="step-num pending" id="sn4">4</div>
            <span class="step-label" id="sl4">Confirmación</span>
        </div>
    </div>

    <!-- PANEL 1: Seleccionar Clase -->
    <div class="panel active" id="panel1">
        <p class="panel-title">Selecciona una clase</p>
        <div class="clases-grid" id="clasesGrid"></div>
    </div>

    <!-- PANEL 2: Fecha y Hora -->
    <div class="panel" id="panel2">
        <p class="panel-title">Elige fecha y hora</p>
        <div class="fecha-grid">
            <div class="calendar-wrap">
                <div class="cal-header">
                    <button class="cal-nav" id="calPrev">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                    </button>
                    <h4 id="calMonthYear"></h4>
                    <button class="cal-nav" id="calNext">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
                <div class="cal-days-header">
                    <span>Lu</span><span>Ma</span><span>Mi</span><span>Ju</span><span>Vi</span><span>Sá</span><span>Do</span>
                </div>
                <div class="cal-days" id="calDays"></div>
            </div>
            <div class="horarios-wrap">
                <h4 id="horariosTitle">Horarios disponibles</h4>
                <div id="horariosContainer">
                    <p class="no-date-msg">Selecciona una fecha para ver los horarios disponibles.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- PANEL 3: Tus Datos -->
    <div class="panel" id="panel3">
        <p class="panel-title">Tus datos de contacto</p>
        <div class="form-grid">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" id="fNombre" placeholder="Tu nombre" />
            </div>
            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" id="fApellidos" placeholder="Tus apellidos" />
            </div>
            <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" id="fEmail" placeholder="correo@ejemplo.com" />
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input type="tel" id="fTelefono" placeholder="+52 999 000 0000" />
            </div>
            <div class="form-group">
                <label>Nivel musical</label>
                <select id="fNivel">
                    <option value="">Selecciona tu nivel</option>
                    <option value="principiante">Principiante</option>
                    <option value="intermedio">Intermedio</option>
                    <option value="avanzado">Avanzado</option>
                </select>
            </div>
            <div class="form-group">
                <label>¿Tienes instrumento propio?</label>
                <select id="fInstrumento">
                    <option value="">Selecciona una opción</option>
                    <option value="si">Sí, tengo mi propio instrumento</option>
                    <option value="no">No, necesito uno del estudio</option>
                </select>
            </div>
            <div class="form-group full">
                <label>Notas adicionales (opcional)</label>
                <textarea id="fNotas" placeholder="Cuéntanos algo sobre tu experiencia musical o cualquier necesidad especial..."></textarea>
            </div>
        </div>
    </div>

    <!-- PANEL 4: Confirmación -->
    <div class="panel" id="panel4">
        <div class="confirm-card">
            <div class="confirm-success">
                <div class="confirm-check">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <h3>¡Reserva Confirmada!</h3>
                <p>Te enviaremos un correo con los detalles de tu reserva.</p>
            </div>
            <div class="confirm-details">
                <div class="confirm-row">
                    <span>Clase</span>
                    <span id="cClase">—</span>
                </div>
                <div class="confirm-row">
                    <span>Profesor</span>
                    <span id="cProfesor">—</span>
                </div>
                <div class="confirm-divider"></div>
                <div class="confirm-row">
                    <span>Fecha</span>
                    <span id="cFecha">—</span>
                </div>
                <div class="confirm-row">
                    <span>Hora</span>
                    <span id="cHora">—</span>
                </div>
                <div class="confirm-row">
                    <span>Duración</span>
                    <span id="cDuracion">—</span>
                </div>
                <div class="confirm-divider"></div>
                <div class="confirm-row">
                    <span>Alumno</span>
                    <span id="cAlumno">—</span>
                </div>
                <div class="confirm-row">
                    <span>Correo</span>
                    <span id="cEmail">—</span>
                </div>
                <div class="confirm-divider"></div>
                <div class="confirm-row confirm-total">
                    <span>Total</span>
                    <span id="cPrecio">—</span>
                </div>
            </div>
            <div class="confirm-note">
                📩 Recibirás un correo de confirmación en las próximas horas. Si tienes alguna duda, contáctanos en <strong>info@pizzicato.mx</strong> o llámanos al <strong>+34 612 345 678</strong>.
            </div>
        </div>
    </div>
</main>

<!-- BOTTOM BAR -->
<div class="bottom-bar">
    <div class="bottom-inner">
        <button class="btn-back" id="btnBack">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Anterior
        </button>
        <button class="btn-next" id="btnNext">
            Siguiente
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </button>
    </div>
</div>

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
                <li>+52 983 123 4567</li>
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
// ── DATA ──
const clases = [
    { id:1, nombre:'Piano Clásico',    profesor:'Prof. Ana López',       duracion:60, instrumento:'piano',   imagen:'https://images.unsplash.com/photo-1520523839897-bd0b52f945a0?w=200&q=80', precio:200, horarios:['10:00','12:00','16:00','18:00'] },
    { id:2, nombre:'Piano Jazz',        profesor:'Prof. Carlos Ramírez',  duracion:60, instrumento:'piano',   imagen:'https://images.unsplash.com/photo-1552422535-c45813c61732?w=200&q=80', precio:200, horarios:['11:00','17:00','19:00'] },
    { id:3, nombre:'Guitarra Acústica', profesor:'Prof. Miguel Torres',   duracion:50, instrumento:'guitarra',imagen:'https://images.unsplash.com/photo-1510915361894-db8b60106cb1?w=200&q=80', precio:200, horarios:['09:00','11:00','15:00','17:00'] },
    { id:4, nombre:'Guitarra Eléctrica',profesor:'Prof. Roberto Sánchez', duracion:50, instrumento:'guitarra',imagen:'https://images.unsplash.com/photo-1564186763535-ebb21ef5277f?w=200&q=80', precio:200, horarios:['10:00','14:00','16:00','18:00'] },
    { id:5, nombre:'Canto Lírico',      profesor:'Prof. Laura Martínez',  duracion:45, instrumento:'canto',  imagen:'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=200&q=80', precio:200, horarios:['09:00','11:00','15:00'] },
    { id:6, nombre:'Canto Popular',     profesor:'Prof. Sofia García',    duracion:45, instrumento:'canto',  imagen:'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=200&q=80', precio:200, horarios:['10:00','13:00','16:00','18:00'] },
    { id:7, nombre:'Ukulele para Principiantes', profesor:'Prof. Jhonatan Catalan', duracion:30, nivel:'principiante', instrumento:'ukulele', imagen:'https://volcanovillagelodge.com/ukulele-history-in-hawaiian-culture', precio:600, horarios:['Lunes 14:00','Miércoles 14:00','Viernes 14:00'] },
    { id:8, nombre:'Ukulele Intermedio',  profesor:'Prof. Jhonatan Catalan', duracion:30, nivel:'intermedio', instrumento:'ukulele', imagen:'https://images.unsplash.com/photo-1508971344143-1c631e9cbbf0?w=600&q=80', precio:600, horarios:['Martes 14:00','Jueves 14:00','Sábado 14:00'] },

];

// ── STATE ──
let currentStep = 1;
let selectedClaseId = <?= $claseIdParam ?: 0 ?>;
let selectedDate  = null;
let selectedHora  = null;
let calYear, calMonth;

const today = new Date();
calYear  = today.getFullYear();
calMonth = today.getMonth();

// ── RENDER STEP 1 ──
function renderClases() {
    const grid = document.getElementById('clasesGrid');
    grid.innerHTML = clases.map(c => `
        <div class="clase-card ${selectedClaseId === c.id ? 'selected' : ''}" data-id="${c.id}" onclick="selectClase(${c.id})">
            <img src="${c.imagen}" alt="${c.nombre}">
            <div class="clase-card-info">
                <h4>${c.nombre}</h4>
                <small>${c.profesor}</small>
                <div class="clase-card-meta">
                    <span>${c.duracion} min</span>
                    <span class="price">$${c.precio}</span>
                </div>
            </div>
            <div class="check-icon">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
        </div>
    `).join('');
}

function selectClase(id) {
    selectedClaseId = id;
    renderClases();
    updateNextBtn();
}

// ── RENDER CALENDAR ──
const monthNames = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

function renderCalendar() {
    document.getElementById('calMonthYear').textContent = `${monthNames[calMonth]} ${calYear}`;
    const firstDay = new Date(calYear, calMonth, 1).getDay();
    const offset   = (firstDay === 0) ? 6 : firstDay - 1; // Monday first
    const daysInMonth = new Date(calYear, calMonth + 1, 0).getDate();
    const container   = document.getElementById('calDays');
    container.innerHTML = '';

    for (let i = 0; i < offset; i++) {
        const el = document.createElement('div');
        el.className = 'cal-day empty';
        container.appendChild(el);
    }

    for (let d = 1; d <= daysInMonth; d++) {
        const date = new Date(calYear, calMonth, d);
        const el   = document.createElement('div');
        el.className = 'cal-day';
        el.textContent = d;

        const isToday = date.toDateString() === today.toDateString();
        const isPast  = date < new Date(today.getFullYear(), today.getMonth(), today.getDate());
        if (isToday) el.classList.add('today');
        if (isPast)  el.classList.add('past');

        if (selectedDate && date.toDateString() === selectedDate.toDateString()) {
            el.classList.add('selected');
        }

        if (!isPast) {
            el.addEventListener('click', () => {
                selectedDate = date;
                selectedHora = null;
                renderCalendar();
                renderHorarios();
                updateNextBtn();
            });
        }
        container.appendChild(el);
    }
}

document.getElementById('calPrev').addEventListener('click', () => {
    calMonth--;
    if (calMonth < 0) { calMonth = 11; calYear--; }
    renderCalendar();
});
document.getElementById('calNext').addEventListener('click', () => {
    calMonth++;
    if (calMonth > 11) { calMonth = 0; calYear++; }
    renderCalendar();
});

// ── RENDER HORARIOS ──
function renderHorarios() {
    const container = document.getElementById('horariosContainer');
    const title     = document.getElementById('horariosTitle');

    if (!selectedDate) {
        title.textContent = 'Horarios disponibles';
        container.innerHTML = '<p class="no-date-msg">Selecciona una fecha para ver los horarios disponibles.</p>';
        return;
    }

    const clase = clases.find(c => c.id === selectedClaseId);
    const slots = clase ? clase.horarios : ['09:00','10:00','11:00','12:00','15:00','16:00','17:00','18:00'];
    const dayStr = selectedDate.toLocaleDateString('es-ES', { weekday:'long', day:'numeric', month:'long' });
    title.textContent = `Horarios — ${dayStr}`;

    // Randomly mark some as unavailable for realism
    const seed = selectedDate.getDate() + selectedDate.getMonth();
    container.innerHTML = `<div class="horario-slots">${
        slots.map((h, i) => {
            const unavailable = (seed + i) % 5 === 0;
            const sel = selectedHora === h;
            return `<button class="slot ${unavailable ? 'unavailable' : ''} ${sel ? 'selected' : ''}" ${unavailable ? 'disabled' : ''} onclick="selectHora('${h}')">${h}</button>`;
        }).join('')
    }</div>`;
}

function selectHora(h) {
    selectedHora = h;
    renderHorarios();
    updateNextBtn();
}

// ── RENDER CONFIRMACIÓN ──
function renderConfirm() {
    const clase  = clases.find(c => c.id === selectedClaseId);
    const nombre = document.getElementById('fNombre').value.trim();
    const apell  = document.getElementById('fApellidos').value.trim();
    const email  = document.getElementById('fEmail').value.trim();
    const dateStr = selectedDate ? selectedDate.toLocaleDateString('es-ES', { weekday:'long', day:'numeric', month:'long', year:'numeric' }) : '—';

    document.getElementById('cClase').textContent    = clase ? clase.nombre : '—';
    document.getElementById('cProfesor').textContent = clase ? clase.profesor : '—';
    document.getElementById('cFecha').textContent    = dateStr;
    document.getElementById('cHora').textContent     = selectedHora || '—';
    document.getElementById('cDuracion').textContent = clase ? `${clase.duracion} min` : '—';
    document.getElementById('cAlumno').textContent   = `${nombre} ${apell}`.trim() || '—';
    document.getElementById('cEmail').textContent    = email || '—';
    document.getElementById('cPrecio').textContent   = clase ? `$${clase.precio} MXN` : '—';
}

// ── STEPPER UPDATE ──
function updateStepper() {
    for (let s = 1; s <= 4; s++) {
        const num = document.getElementById(`sn${s}`);
        const lbl = document.getElementById(`sl${s}`);
        num.className = 'step-num ' + (s < currentStep ? 'done' : s === currentStep ? 'active' : 'pending');
        lbl.className = 'step-label' + (s === currentStep ? ' active' : '');
        if (s < 4) {
            document.getElementById(`line${s}`).className = 'step-line' + (s < currentStep ? ' done' : '');
        }
        if (s < currentStep) num.innerHTML = `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>`;
        else num.textContent = s;
    }
}

function updateNextBtn() {
    const btn = document.getElementById('btnNext');
    if (currentStep === 1) btn.disabled = !selectedClaseId;
    else if (currentStep === 2) btn.disabled = !selectedDate || !selectedHora;
    else if (currentStep === 3) {
        const nombre = document.getElementById('fNombre').value.trim();
        const email  = document.getElementById('fEmail').value.trim();
        btn.disabled = !nombre || !email;
    }
    else btn.disabled = false;

    btn.textContent = currentStep === 3 ? 'Confirmar Reserva' : 'Siguiente';
    if (currentStep < 3) {
        btn.innerHTML += ` <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>`;
    }
    if (currentStep === 4) btn.classList.add('hidden');
    else btn.classList.remove('hidden');
}

// ── NAVIGATION ──
function goTo(step) {
    document.querySelectorAll('.panel').forEach((p, i) => {
        p.classList.toggle('active', i + 1 === step);
    });
    document.getElementById('btnBack').style.visibility = step === 1 ? 'hidden' : 'visible';
    currentStep = step;
    updateStepper();
    updateNextBtn();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

document.getElementById('btnNext').addEventListener('click', () => {
    if (currentStep < 4) {
        if (currentStep === 3) renderConfirm();
        goTo(currentStep + 1);
    }
});

document.getElementById('btnBack').addEventListener('click', () => {
    if (currentStep > 1) goTo(currentStep - 1);
});

// Live validation step 3
['fNombre','fEmail'].forEach(id => {
    document.getElementById(id).addEventListener('input', updateNextBtn);
});

// ── INIT ──
renderClases();
renderCalendar();
goTo(1);
</script>
</body>
</html>
