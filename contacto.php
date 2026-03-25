<?php
$nombreEstudio = "Pizzicato";
$anioActual = date("Y");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto | Pizzicato - Estudio de Artes Musicales</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --brown:  #8B4513;
            --green:  #8B9A7D;
            --terra:  #C4785A;
            --terra2: #B06B4F;
            --dark:  #2D2424;
            --dark2:   #2D2D2D;
            --bg:     #FAF8F5;
            --sand:   #E8E0D5;
            --cream:  #FFF8F0;
            --light:  #F5E6D3;
        }

        body {
            background: var(--bg);
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
            font-size: 1rem;
        }
        .logo strong {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            display: block;
            line-height: 1.1;
        }
        .logo small { font-size: 0.6rem; color: #777; }

        nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
        }
        nav ul li a {
            text-decoration: none;
            font-size: 0.9rem;
            color: rgba(45,45,45,0.7);
            transition: color 0.2s;
        }
        nav ul li a:hover { color: var(--brown); }
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

        /* ── HERO / MAIN GRID ── */
        .hero { padding: 5rem 2rem; }
        .hero-inner {
            max-width: 72rem;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: start;
        }
        @media (max-width: 900px) {
            .hero-inner { grid-template-columns: 1fr; gap: 2.5rem; }
        }

        .eyebrow {
            color: var(--green);
            font-size: 0.75rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            font-weight: 500;
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            color: var(--dark);
            margin: 1rem 0 1.5rem;
            line-height: 1.1;
        }
        .hero-lead {
            font-size: 1.05rem;
            color: rgba(45,45,45,0.6);
            line-height: 1.75;
            margin-bottom: 2.5rem;
        }

        /* Info cards */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        @media (max-width: 500px) { .info-grid { grid-template-columns: 1fr; } }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }

        .info-card {
            background: white;
            border-radius: 1rem;
            padding: 1.25rem;
            transition: box-shadow 0.3s ease;
            opacity: 0;
            animation: fadeUp 0.4s ease forwards;
        }
        .info-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
        .info-card:nth-child(1) { animation-delay: 0.05s; }
        .info-card:nth-child(2) { animation-delay: 0.15s; }
        .info-card:nth-child(3) { animation-delay: 0.25s; }
        .info-card:nth-child(4) { animation-delay: 0.35s; }

        .info-icon {
            width: 2.5rem; height: 2.5rem;
            background: var(--sand);
            border-radius: 0.75rem;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 0.75rem;
            color: var(--terra);
        }
        .info-card h3 { font-size: 0.8rem; font-weight: 500; color: var(--dark); margin-bottom: 0.25rem; }
        .info-card a, .info-card p {
            font-size: 0.82rem;
            color: rgba(45,45,45,0.6);
            line-height: 1.5;
            text-decoration: none;
            white-space: pre-line;
        }
        .info-card a:hover { color: var(--terra); }

        /* Social */
        .social-row { display: flex; align-items: center; gap: 1rem; margin-top: 0.5rem; }
        .social-label { font-size: 0.85rem; color: rgba(45,45,45,0.6); }
        .social-btn {
            width: 2.5rem; height: 2.5rem;
            background: var(--sand);
            border-radius: 9999px;
            display: flex; align-items: center; justify-content: center;
            color: rgba(45,45,45,0.6);
            text-decoration: none;
            transition: background 0.25s, color 0.25s;
        }
        .social-btn:hover { background: var(--terra); color: white; }

        /* ── FORM ── */
        .form-card {
            background: white;
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            opacity: 0;
            animation: fadeUp 0.5s 0.2s ease forwards;
        }
        .form-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: var(--dark);
            margin-bottom: 1.75rem;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 1.25rem;
        }
        @media (max-width: 500px) { .form-row { grid-template-columns: 1fr; } }

        .form-group { display: flex; flex-direction: column; gap: 0.4rem; margin-bottom: 1.25rem; }

        label { font-size: 0.85rem; font-weight: 500; color: var(--dark); }
        input, textarea {
            background: var(--bg);
            border: 1px solid var(--sand);
            border-radius: 0.6rem;
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            width: 100%;
        }
        input::placeholder, textarea::placeholder { color: rgba(45,45,45,0.35); }
        input:focus, textarea:focus {
            border-color: var(--terra);
            box-shadow: 0 0 0 3px rgba(196,120,90,0.12);
        }
        textarea { resize: vertical; min-height: 130px; }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: var(--terra);
            color: white;
            border: none;
            border-radius: 0.6rem;
            font-size: 1rem;
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: background 0.25s;
            margin-top: 1.5rem;
        }
        .submit-btn:hover { background: var(--terra2); }
        .submit-btn:disabled { opacity: 0.7; cursor: not-allowed; }

        @keyframes spin { to { transform: rotate(360deg); } }
        .spinner {
            width: 1rem; height: 1rem;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        /* Success state */
        .success-card {
            background: white;
            border-radius: 1.5rem;
            padding: 3rem 2rem;
            text-align: center;
            display: none;
        }
        .success-icon {
            width: 4rem; height: 4rem;
            background: var(--green);
            border-radius: 9999px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
        }
        .success-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: var(--dark);
            margin-bottom: 0.75rem;
        }
        .success-card p { color: rgba(45,45,45,0.6); margin-bottom: 1.5rem; }
        .reset-btn {
            padding: 0.65rem 1.5rem;
            border: 1px solid var(--sand);
            border-radius: 0.6rem;
            background: white;
            color: var(--dark);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .reset-btn:hover { background: var(--bg); }

        /* ── MAP ── */
        .map-section { padding: 4rem 2rem; background: rgba(232,224,213,0.3); }
        .map-inner { max-width: 72rem; margin: 0 auto; }
        .map-wrap { border-radius: 1.5rem; overflow: hidden; height: 400px; }
        .map-wrap iframe { width: 100%; height: 100%; border: 0; display: block; }

        /* ── FAQ ── */
        .faq-section { padding: 6rem 2rem; }
        .faq-inner { max-width: 48rem; margin: 0 auto; }
        .faq-header { text-align: center; margin-bottom: 3rem; }
        .faq-header .eyebrow { display: block; margin-bottom: 1rem; }
        .faq-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: var(--dark);
        }
        .faq-item {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            opacity: 0;
            animation: fadeUp 0.4s ease forwards;
        }
        .faq-item:nth-child(1) { animation-delay: 0.05s; }
        .faq-item:nth-child(2) { animation-delay: 0.1s; }
        .faq-item:nth-child(3) { animation-delay: 0.15s; }
        .faq-item:nth-child(4) { animation-delay: 0.2s; }
        .faq-item h3 { font-weight: 500; color: var(--dark); margin-bottom: 0.5rem; }
        .faq-item p { color: rgba(45,45,45,0.6); font-size: 0.92rem; line-height: 1.65; }

        /* ── FOOTER ── */
        footer {
            background: var(--dark2);
            color: rgba(255,255,255,0.5);
            text-align: center;
            padding: 2rem;
            font-size: 0.85rem;
        }
        footer span { color: rgba(255,255,255,0.8); font-family: 'Playfair Display', serif; }
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
            <li><a href="eventos.php">Eventos</a></li>
            <li><a href="contacto.php" class="active">Contacto</a></li>
        </ul>
    </nav>
    <a href="clases.php" class="btn-reserva">RESERVAR CLASE</a>
</header>

<!-- HERO -->
<section class="hero">
    <div class="hero-inner">

        <!-- Left: info -->
        <div>
            <span class="eyebrow">Contacto</span>
            <h1>Estamos aquí para ti</h1>
            <p class="hero-lead">¿Tienes alguna pregunta? Nos encantaría saber de ti. Rellena el formulario o utiliza cualquiera de nuestros canales de contacto.</p>

            <div class="info-grid">
                <div class="info-card">
                    <div class="info-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <h3>Ubicación</h3>
                    <a href="https://maps.app.goo.gl/8h5wXf7QB4uh3wfJ9" target="_blank" rel="noopener noreferrer">Av. 4 de Marzo & Rtno. 7, Payo Obispo, 77083 Chetumal, Q.R.</a>
                </div>
                <div class="info-card">
                    <div class="info-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <h3>Teléfono</h3>
                    <a href="tel:+529831234567">+52 --- --- ----</a>
                </div>
                <div class="info-card">
                    <div class="info-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <h3>Email</h3>
                    <a href="mailto:info@pizzicato.mx">info@pizzicato.mx</a>
                </div>
                <div class="info-card">
                    <div class="info-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <h3>Horario</h3>
                    <p>Lun - Vie: 7:00 - 21:00
Sáb - Dom: 9:00 - 14:00</p>
                </div>
            </div>

            <div class="social-row">
                <span class="social-label">Síguenos:</span>
                <a href="#" class="social-btn" aria-label="Instagram">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </a>
                <a href="#" class="social-btn" aria-label="Facebook">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
            </div>
        </div>

        <!-- Right: form -->
        <div>
            <div class="form-card" id="formCard">
                <h2>Envíanos un mensaje</h2>
                <form id="contactForm" novalidate>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre">Nombre *</label>
                            <input type="text" id="nombre" placeholder="Tu nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" placeholder="tu@email.com" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="tel" id="telefono" placeholder="+52 983 123 4567">
                        </div>
                        <div class="form-group">
                            <label for="asunto">Asunto</label>
                            <input type="text" id="asunto" placeholder="¿Sobre qué quieres hablar?">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mensaje">Mensaje *</label>
                        <textarea id="mensaje" placeholder="Cuéntanos en qué podemos ayudarte..." required></textarea>
                    </div>
                    <button type="submit" class="submit-btn" id="submitBtn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Enviar mensaje
                    </button>
                </form>
            </div>

            <div class="success-card" id="successCard">
                <div class="success-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <h2>¡Mensaje enviado!</h2>
                <p>Gracias por contactarnos. Te responderemos lo antes posible.</p>
                <button class="reset-btn" id="resetBtn">Enviar otro mensaje</button>
            </div>
        </div>

    </div>
</section>

<!-- MAP -->
<section class="map-section">
    <div class="map-inner">
        <div class="map-wrap">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.9924862120333!2d-88.3182286250368!3d18.529241682566088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f5ba5c9f99f9d41%3A0xe9fcdf90c0021146!2sEstudio%20de%20Artes%20Musicales%20Pizzicato!5e0!3m2!1sen!2smx!4v1772747993081!5m2!1sen!2smx"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Mapa de ubicación">
            </iframe>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="faq-section">
    <div class="faq-inner">
        <div class="faq-header">
            <span class="eyebrow">FAQ</span>
            <h2>Preguntas frecuentes</h2>
        </div>
        <div id="faqList"></div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <p>&copy; <?= $anioActual ?> <span><?= $nombreEstudio ?></span> — Estudio de Artes Musicales. Todos los derechos reservados.</p>
</footer>

<script>
const faqs = [
    { question: '¿Necesito experiencia previa?', answer: 'No, tenemos clases para todos los niveles, incluyendo principiantes absolutos.' },
    { question: '¿Qué debo llevar a clase?', answer: 'Ropa cómoda y ganas de disfrutar. Proporcionamos esterillas y todo el material necesario.' },
    { question: '¿Puedo cancelar mi reserva?', answer: 'Sí, puedes cancelar hasta 12 horas antes de la clase sin ningún cargo.' },
    { question: '¿Ofrecen clases privadas?', answer: 'Sí, contacta con nosotros para más información sobre sesiones personalizadas.' }
];

document.getElementById('faqList').innerHTML = faqs.map(f => `
    <div class="faq-item">
        <h3>${f.question}</h3>
        <p>${f.answer}</p>
    </div>`).join('');

const form        = document.getElementById('contactForm');
const formCard    = document.getElementById('formCard');
const successCard = document.getElementById('successCard');
const submitBtn   = document.getElementById('submitBtn');
const resetBtn    = document.getElementById('resetBtn');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const nombre  = document.getElementById('nombre').value.trim();
    const email   = document.getElementById('email').value.trim();
    const mensaje = document.getElementById('mensaje').value.trim();

    if (!nombre || !email || !mensaje) {
        alert('Por favor completa los campos obligatorios.');
        return;
    }

    submitBtn.disabled = true;
    submitBtn.innerHTML = `<div class="spinner"></div> Enviando...`;

    try {
        const res  = await fetch('api/contacto.php', {
            method:  'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                nombre,
                correo:   email,
                telefono: document.getElementById('telefono').value.trim(),
                asunto:   document.getElementById('asunto').value.trim(),
                mensaje,
            }),
        });
        const data = await res.json();
        if (!res.ok || data.error) throw new Error(data.error || 'Error al enviar');

        formCard.style.display    = 'none';
        successCard.style.display = 'block';

    } catch (err) {
        alert('No se pudo enviar el mensaje: ' + err.message);
        submitBtn.disabled = false;
        submitBtn.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg> Enviar mensaje`;
    }
});

resetBtn.addEventListener('click', () => {
    form.reset();
    successCard.style.display = 'none';
    formCard.style.display = 'block';
    submitBtn.disabled = false;
    submitBtn.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg> Enviar mensaje`;
});
</script>

</body>
</html>
