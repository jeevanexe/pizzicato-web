<?php
$nombreEstudio = "Pizzicato";
$anioActual = date("Y");
$seccion = isset($_GET['sec']) ? $_GET['sec'] : 'inicio';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | <?= $nombreEstudio ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --brown:#8B4513; --brown2:#6B3410; --dark:#2D2424; --dark2:#2D2D2D;
            --cream:#FFF8F0; --light:#F5E6D3; --gold:#D4AF37;
            --success:#22c55e; --danger:#e74c3c;
        }
        body { background:var(--light); font-family:'DM Sans',sans-serif; color:var(--dark); min-height:100vh; display:flex; flex-direction:column; }

        /* TOPBAR */
        .topbar { position:sticky; top:0; z-index:200; background:var(--cream); border-bottom:1px solid var(--light); display:flex; align-items:center; justify-content:space-between; padding:.85rem 1.5rem; gap:1rem; }
        .topbar-left { display:flex; align-items:center; gap:.75rem; }
        .logo-icon { width:2.2rem; height:2.2rem; background:var(--brown); border-radius:.5rem; display:flex; align-items:center; justify-content:center; color:white; }
        .logo-icon svg { width:14px; height:14px; }
        .logo-text strong { font-family:'Playfair Display',serif; font-size:1.05rem; display:block; line-height:1.1; }
        .logo-text small { font-size:.6rem; color:rgba(45,36,36,.5); }
        .topbar-divider { width:1px; height:1.5rem; background:var(--light); }
        .topbar-section { font-size:.85rem; color:rgba(45,36,36,.5); }
        .topbar-right { display:flex; align-items:center; gap:.75rem; }
        .topbar-link { font-size:.8rem; color:rgba(45,36,36,.55); text-decoration:none; display:flex; align-items:center; gap:.35rem; transition:color .2s; }
        .topbar-link:hover { color:var(--brown); }
        .topbar-link svg { width:14px; height:14px; }
        .avatar { width:2rem; height:2rem; border-radius:50%; background:var(--brown); color:white; display:flex; align-items:center; justify-content:center; font-size:.75rem; font-weight:500; cursor:pointer; }

        /* LAYOUT */
        .dash-layout { display:flex; flex:1; min-height:calc(100vh - 57px); }

        /* SIDEBAR */
        .sidebar { width:220px; flex-shrink:0; background:var(--cream); border-right:1px solid var(--light); display:flex; flex-direction:column; padding:1.25rem 0; position:sticky; top:57px; height:calc(100vh - 57px); overflow-y:auto; }
        .nav-group-label { font-size:.65rem; font-weight:500; color:rgba(45,36,36,.4); text-transform:uppercase; letter-spacing:.12em; padding:0 1.25rem; margin-bottom:.35rem; margin-top:1rem; }
        .nav-group-label:first-child { margin-top:0; }
        .nav-item { display:flex; align-items:center; gap:.65rem; padding:.6rem 1.25rem; font-size:.875rem; color:rgba(45,36,36,.65); text-decoration:none; cursor:pointer; border-left:2px solid transparent; transition:all .2s; }
        .nav-item:hover { background:var(--light); color:var(--dark); }
        .nav-item.active { background:rgba(139,69,19,.08); color:var(--brown); border-left-color:var(--brown); font-weight:500; }
        .nav-item svg { width:16px; height:16px; flex-shrink:0; }
        .nav-badge { margin-left:auto; background:var(--light); color:rgba(45,36,36,.55); font-size:.7rem; padding:1px 7px; border-radius:99px; }
        .nav-item.active .nav-badge { background:rgba(139,69,19,.15); color:var(--brown); }
        .sidebar-footer { margin-top:auto; padding:1rem 1.25rem 0; border-top:1px solid var(--light); }
        .sidebar-user { display:flex; align-items:center; gap:.65rem; }
        .sidebar-user .avatar { width:2.2rem; height:2.2rem; font-size:.8rem; }
        .sidebar-user-info strong { font-size:.82rem; display:block; color:var(--dark); }
        .sidebar-user-info small { font-size:.7rem; color:rgba(45,36,36,.45); }

        /* CONTENT */
        .content { flex:1; padding:2rem; overflow-y:auto; }

        /* SECTION HEADER */
        .sec-head { display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:1.75rem; }
        .sec-head h1 { font-family:'Playfair Display',serif; font-size:1.75rem; color:var(--dark); }
        .sec-head p { font-size:.875rem; color:rgba(45,36,36,.55); margin-top:.2rem; }

        /* BUTTONS */
        .btn { display:inline-flex; align-items:center; gap:.4rem; padding:.6rem 1.2rem; border-radius:9999px; font-size:.8rem; font-weight:500; font-family:'DM Sans',sans-serif; cursor:pointer; border:none; letter-spacing:.04em; transition:all .2s; text-decoration:none; }
        .btn svg { width:14px; height:14px; }
        .btn-primary { background:var(--brown); color:white; }
        .btn-primary:hover { background:var(--brown2); }
        .btn-secondary { background:white; color:rgba(45,36,36,.7); border:1px solid var(--light); }
        .btn-secondary:hover { border-color:var(--brown); color:var(--brown); }
        .btn-danger { background:rgba(231,76,60,.1); color:var(--danger); border:1px solid rgba(231,76,60,.2); }
        .btn-danger:hover { background:rgba(231,76,60,.18); }
        .btn-sm { padding:.35rem .75rem; font-size:.75rem; }
        .btn:disabled { opacity:.5; cursor:not-allowed; }

        /* STATS */
        .stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:2rem; }
        @media(max-width:900px){ .stats-grid { grid-template-columns:1fr 1fr; } }
        .stat-card { background:white; border-radius:1rem; padding:1.25rem; border:1px solid rgba(245,230,211,.8); }
        .stat-icon { width:2.25rem; height:2.25rem; border-radius:.6rem; background:var(--light); display:flex; align-items:center; justify-content:center; color:var(--brown); margin-bottom:.75rem; }
        .stat-icon svg { width:16px; height:16px; }
        .stat-label { font-size:.75rem; color:rgba(45,36,36,.5); margin-bottom:.25rem; }
        .stat-val { font-family:'Playfair Display',serif; font-size:1.85rem; color:var(--dark); line-height:1; }
        .stat-delta { font-size:.75rem; color:var(--success); margin-top:.35rem; }
        .stat-delta.neutral { color:rgba(45,36,36,.4); }

        /* CARDS */
        .card { background:white; border-radius:1rem; border:1px solid rgba(245,230,211,.8); overflow:hidden; margin-bottom:1.5rem; }
        .card-header { display:flex; align-items:center; justify-content:space-between; padding:1rem 1.25rem; border-bottom:1px solid var(--light); }
        .card-header h2 { font-family:'Playfair Display',serif; font-size:1.1rem; color:var(--dark); }

        /* TABLE */
        .tbl { width:100%; border-collapse:collapse; }
        .tbl th { font-size:.7rem; font-weight:500; color:rgba(45,36,36,.45); text-transform:uppercase; letter-spacing:.1em; padding:.75rem 1.25rem; text-align:left; background:rgba(245,230,211,.3); border-bottom:1px solid var(--light); }
        .tbl td { padding:.85rem 1.25rem; font-size:.875rem; border-bottom:1px solid rgba(245,230,211,.6); vertical-align:middle; }
        .tbl tr:last-child td { border-bottom:none; }
        .tbl tr:hover td { background:rgba(255,248,240,.7); }
        .tbl-muted { color:rgba(45,36,36,.5); }
        .cell-img { display:flex; align-items:center; gap:.65rem; }
        .cell-thumb { width:2.5rem; height:2.5rem; border-radius:.5rem; background:var(--light); object-fit:cover; flex-shrink:0; display:flex; align-items:center; justify-content:center; color:rgba(45,36,36,.3); overflow:hidden; }
        .cell-thumb svg { width:14px; height:14px; }
        .cell-thumb img { width:100%; height:100%; object-fit:cover; }
        .cell-name { font-weight:500; font-size:.875rem; }
        .cell-sub { font-size:.75rem; color:rgba(45,36,36,.5); }
        .pill { display:inline-block; padding:.2rem .65rem; border-radius:99px; font-size:.72rem; font-weight:500; }
        .pill-green { background:rgba(34,197,94,.12); color:#15803d; }
        .pill-amber { background:rgba(212,175,55,.15); color:#92600a; }
        .pill-gray  { background:var(--light); color:rgba(45,36,36,.55); }
        .row-actions { display:flex; gap:.4rem; }

        /* LOADING row */
        .tbl-loading { text-align:center; padding:2rem; color:rgba(45,36,36,.4); font-size:.875rem; }
        .tbl-empty   { text-align:center; padding:2.5rem; color:rgba(45,36,36,.35); font-size:.875rem; }

        /* FORM */
        .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:1rem; padding:1.25rem; }
        @media(max-width:700px){ .form-grid { grid-template-columns:1fr; } }
        .form-group { display:flex; flex-direction:column; gap:.4rem; }
        .form-group.full { grid-column:1/-1; }
        .form-group label { font-size:.78rem; font-weight:500; color:rgba(45,36,36,.6); text-transform:uppercase; letter-spacing:.08em; }
        .form-group input, .form-group select, .form-group textarea { background:var(--cream); border:1px solid var(--light); border-radius:.65rem; padding:.65rem .9rem; font-size:.875rem; color:var(--dark); font-family:'DM Sans',sans-serif; outline:none; transition:border-color .2s,box-shadow .2s; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color:var(--brown); box-shadow:0 0 0 3px rgba(139,69,19,.1); }
        .form-group textarea { resize:vertical; min-height:5rem; }
        .form-footer { display:flex; justify-content:flex-end; gap:.75rem; padding:1rem 1.25rem; border-top:1px solid var(--light); }

        /* HORARIOS DINÁMICOS */
        .horarios-list { display:flex; flex-direction:column; gap:.5rem; margin-bottom:.5rem; }
        .horario-row { display:flex; gap:.5rem; align-items:center; }
        .horario-row select, .horario-row input[type=time] { flex:1; padding:.5rem .75rem; border-radius:.65rem; border:1px solid var(--light); background:var(--cream); font-family:'DM Sans',sans-serif; font-size:.875rem; color:var(--dark); outline:none; }
        .horario-row select:focus, .horario-row input[type=time]:focus { border-color:var(--brown); }
        .btn-del-horario { width:1.8rem; height:1.8rem; border-radius:50%; background:rgba(231,76,60,.1); border:none; color:var(--danger); cursor:pointer; font-size:1rem; line-height:1; display:flex; align-items:center; justify-content:center; flex-shrink:0; }

        /* UPLOAD */
        .upload-zone { border:2px dashed var(--light); border-radius:.85rem; padding:2rem; text-align:center; cursor:pointer; transition:border-color .2s,background .2s; margin:1.25rem; }
        .upload-zone:hover { border-color:var(--brown); background:rgba(255,248,240,.6); }
        .upload-icon { width:3rem; height:3rem; background:var(--light); border-radius:.75rem; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; color:var(--brown); }
        .upload-icon svg { width:20px; height:20px; }
        .upload-zone h4 { font-size:.9rem; font-weight:500; color:var(--dark); margin-bottom:.3rem; }
        .upload-zone p { font-size:.8rem; color:rgba(45,36,36,.5); }
        .upload-zone input[type=file] { display:none; }
        .upload-tags { display:flex; gap:.5rem; justify-content:center; margin-top:1rem; flex-wrap:wrap; }
        .upload-tag { padding:.3rem .8rem; border-radius:99px; border:1px solid var(--light); background:white; font-size:.75rem; color:rgba(45,36,36,.6); cursor:pointer; transition:all .2s; }
        .upload-tag:hover, .upload-tag.selected { background:var(--brown); color:white; border-color:var(--brown); }

        /* IMAGE GRID */
        .img-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(130px,1fr)); gap:.75rem; padding:1.25rem; }
        .img-item { position:relative; border-radius:.6rem; overflow:hidden; aspect-ratio:4/3; background:var(--light); }
        .img-item img { width:100%; height:100%; object-fit:cover; display:block; }
        .img-item-overlay { position:absolute; inset:0; background:rgba(45,36,36,0); display:flex; align-items:center; justify-content:center; gap:.35rem; transition:background .2s; }
        .img-item:hover .img-item-overlay { background:rgba(45,36,36,.55); }
        .img-item-overlay button { background:white; border:none; border-radius:.4rem; padding:.3rem .55rem; font-size:.7rem; font-family:'DM Sans',sans-serif; cursor:pointer; opacity:0; transform:translateY(4px); transition:opacity .2s,transform .2s; font-weight:500; }
        .img-item:hover .img-item-overlay button { opacity:1; transform:translateY(0); }
        .img-item-overlay .del-img { color:var(--danger); }
        .img-label { position:absolute; bottom:0; left:0; right:0; background:rgba(45,36,36,.65); color:white; font-size:.65rem; padding:.25rem .5rem; text-align:center; }
        .copy-btn-wrap { display:flex; gap:.4rem; align-items:center; padding:.3rem .5rem; }
        .copy-url { font-size:.6rem; color:rgba(45,36,36,.45); word-break:break-all; flex:1; }

        /* TWO COL */
        .two-col { display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; }
        @media(max-width:900px){ .two-col { grid-template-columns:1fr; } }

        /* MODAL */
        .modal-overlay { position:fixed; inset:0; background:rgba(45,36,36,.5); z-index:500; display:none; align-items:center; justify-content:center; padding:1rem; }
        .modal-overlay.open { display:flex; }
        .modal { background:var(--cream); border-radius:1.25rem; width:100%; max-width:44rem; max-height:90vh; overflow-y:auto; box-shadow:0 20px 60px rgba(45,36,36,.25); animation:slideUp .25s ease; }
        @keyframes slideUp { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
        .modal-header { display:flex; align-items:center; justify-content:space-between; padding:1.25rem 1.5rem; border-bottom:1px solid var(--light); }
        .modal-header h3 { font-family:'Playfair Display',serif; font-size:1.25rem; }
        .modal-close { width:2rem; height:2rem; border-radius:50%; background:var(--light); border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; color:rgba(45,36,36,.6); transition:background .2s; }
        .modal-close:hover { background:#e8d8c4; }
        .modal-close svg { width:14px; height:14px; }

        /* TOAST */
        .toast { position:fixed; bottom:1.5rem; right:1.5rem; z-index:1000; background:var(--dark2); color:white; padding:.75rem 1.25rem; border-radius:.65rem; font-size:.875rem; display:flex; align-items:center; gap:.5rem; transform:translateY(80px); opacity:0; transition:all .3s ease; }
        .toast.show { transform:translateY(0); opacity:1; }
        .toast.success { background:#166534; }
        .toast.error { background:#991b1b; }
        .toast svg { width:16px; height:16px; }

        /* SPINNER */
        .spinner { display:inline-block; width:13px; height:13px; border:2px solid rgba(255,255,255,.35); border-top-color:white; border-radius:50%; animation:spin .7s linear infinite; }
        @keyframes spin { to{transform:rotate(360deg)} }

        /* SECTIONS */
        .section { display:none; }
        .section.active { display:block; }

        .empty-state { text-align:center; padding:3rem 2rem; color:rgba(45,36,36,.4); }
        .empty-state svg { width:2.5rem; height:2.5rem; margin-bottom:.75rem; opacity:.3; }
        .empty-state p { font-size:.9rem; }

        /* RESERVA FILTER PILLS */
        .reserva-filter { border-radius:9999px !important; }
        .reserva-filter.active { background:var(--brown) !important; color:white !important; border-color:var(--brown) !important; }

        /* ACCIÓN RÁPIDA RESERVA */
        .btn-aceptar { background:rgba(34,197,94,.12); color:#15803d; border:1px solid rgba(34,197,94,.25); }
        .btn-aceptar:hover { background:rgba(34,197,94,.22); }
        .btn-rechazar { background:rgba(231,76,60,.1); color:var(--danger); border:1px solid rgba(231,76,60,.2); }
        .btn-rechazar:hover { background:rgba(231,76,60,.18); }

        /* IMAGEN PICKER dentro del modal */
        .img-input-wrap { display:flex; gap:.5rem; align-items:center; }
        .img-input-wrap input { flex:1; }
        .btn-biblioteca { display:inline-flex; align-items:center; gap:.35rem; padding:.55rem .9rem; border-radius:.65rem; background:white; border:1px solid var(--light); font-size:.78rem; font-family:'DM Sans',sans-serif; color:rgba(45,36,36,.7); cursor:pointer; white-space:nowrap; transition:all .2s; flex-shrink:0; }
        .btn-biblioteca:hover { border-color:var(--brown); color:var(--brown); }
        .btn-biblioteca svg { width:13px; height:13px; }
        .img-preview-wrap { margin-top:.6rem; position:relative; border-radius:.65rem; overflow:hidden; border:1px solid var(--light); display:none; }
        .img-preview-wrap img { width:100%; height:110px; object-fit:cover; display:block; }
        .img-preview-remove { position:absolute; top:6px; right:6px; background:rgba(45,36,36,.65); border:none; border-radius:50%; width:1.6rem; height:1.6rem; cursor:pointer; color:white; font-size:.85rem; line-height:1; display:flex; align-items:center; justify-content:center; }

        /* MODAL BIBLIOTECA PICKER */
        .bib-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(130px,1fr)); gap:.65rem; max-height:52vh; overflow-y:auto; padding:1.25rem; }
        .bib-item { position:relative; border-radius:.6rem; overflow:hidden; aspect-ratio:4/3; cursor:pointer; border:2px solid transparent; transition:border-color .2s,transform .15s; }
        .bib-item:hover { border-color:var(--brown); transform:scale(1.03); }
        .bib-item img { width:100%; height:100%; object-fit:cover; display:block; }
        .bib-item-label { position:absolute; bottom:0; left:0; right:0; background:rgba(45,36,36,.65); color:white; font-size:.6rem; padding:.2rem .4rem; text-align:center; }
        .bib-item-check { position:absolute; top:5px; right:5px; width:1.3rem; height:1.3rem; background:var(--brown); border-radius:50%; display:none; align-items:center; justify-content:center; }
        .bib-item:hover .bib-item-check { display:flex; }
    </style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <div class="topbar-left">
        <div class="logo-icon">
            <svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
        </div>
        <div class="logo-text">
            <strong><?= $nombreEstudio ?></strong>
            <small>Estudio de Artes Musicales</small>
        </div>
        <div class="topbar-divider"></div>
        <span class="topbar-section" id="topbarSection">Panel de administración</span>
    </div>
    <div class="topbar-right">
        <a href="home.php" class="topbar-link" target="_blank">
            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            Ver sitio
        </a>
        <div class="avatar" title="Jhonatan Catalan">JC</div>
    </div>
</div>

<div class="dash-layout">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <span class="nav-group-label">General</span>
        <a class="nav-item active" data-sec="inicio" onclick="goTo('inicio',this)">
            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Inicio
        </a>
        <span class="nav-group-label">Contenido</span>
        <a class="nav-item" data-sec="clases" onclick="goTo('clases',this)">
            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
            Clases <span class="nav-badge" id="badge-clases">—</span>
        </a>
        <a class="nav-item" data-sec="eventos" onclick="goTo('eventos',this)">
            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Eventos <span class="nav-badge" id="badge-eventos">—</span>
        </a>
        <a class="nav-item" data-sec="imagenes" onclick="goTo('imagenes',this)">
            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            Imágenes <span class="nav-badge" id="badge-imagenes">—</span>
        </a>
        <span class="nav-group-label">Sistema</span>
        <a class="nav-item" data-sec="reservas" onclick="goTo('reservas',this)">
            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            Reservas <span class="nav-badge" id="badge-reservas">—</span>
        </a>
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="avatar">JC</div>
                <div class="sidebar-user-info">
                    <strong>Jhonatan Catalan</strong>
                    <small>Maestro · Admin</small>
                </div>
            </div>
        </div>
    </aside>

    <main class="content">

        <!-- ══ INICIO ══ -->
        <div class="section active" id="sec-inicio">
            <div class="sec-head">
                <div><h1>Bienvenido, Jhonatan</h1><p>Resumen rápido del estudio.</p></div>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg></div>
                    <div class="stat-label">Clases activas</div>
                    <div class="stat-val" id="stat-clases">—</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                    <div class="stat-label">Eventos próximos</div>
                    <div class="stat-val" id="stat-eventos">—</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
                    <div class="stat-label">Reservas pendientes</div>
                    <div class="stat-val" id="stat-reservas">—</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div>
                    <div class="stat-label">Imágenes subidas</div>
                    <div class="stat-val" id="stat-imagenes">—</div>
                </div>
            </div>
            <div class="two-col">
                <div class="card">
                    <div class="card-header"><h2>Clases recientes</h2><button class="btn btn-secondary btn-sm" onclick="goTo('clases',document.querySelector('[data-sec=clases]'))">Ver todas</button></div>
                    <table class="tbl" id="tbl-inicio-clases"><tr><td class="tbl-loading">Cargando...</td></tr></table>
                </div>
                <div class="card">
                    <div class="card-header"><h2>Próximos eventos</h2><button class="btn btn-secondary btn-sm" onclick="goTo('eventos',document.querySelector('[data-sec=eventos]'))">Ver todos</button></div>
                    <table class="tbl" id="tbl-inicio-eventos"><tr><td class="tbl-loading">Cargando...</td></tr></table>
                </div>
            </div>
        </div>

        <!-- ══ CLASES ══ -->
        <div class="section" id="sec-clases">
            <div class="sec-head">
                <div><h1>Clases</h1><p>Gestiona las clases del estudio.</p></div>
                <button class="btn btn-primary" onclick="abrirModalClase()">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Nueva clase
                </button>
            </div>
            <div class="card">
                <div class="card-header"><h2>Todas las clases</h2></div>
                <table class="tbl" id="tbl-clases"><tr><td class="tbl-loading">Cargando...</td></tr></table>
            </div>
        </div>

        <!-- ══ EVENTOS ══ -->
        <div class="section" id="sec-eventos">
            <div class="sec-head">
                <div><h1>Eventos</h1><p>Gestiona los eventos y conciertos.</p></div>
                <button class="btn btn-primary" onclick="abrirModalEvento()">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Nuevo evento
                </button>
            </div>
            <div class="card">
                <div class="card-header"><h2>Todos los eventos</h2></div>
                <table class="tbl" id="tbl-eventos"><tr><td class="tbl-loading">Cargando...</td></tr></table>
            </div>
        </div>

        <!-- ══ IMÁGENES ══ -->
        <div class="section" id="sec-imagenes">
            <div class="sec-head"><div><h1>Imágenes</h1><p>Sube y gestiona imágenes para clases y eventos.</p></div></div>
            <div class="two-col">
                <div class="card">
                    <div class="card-header"><h2>Subir imagen</h2></div>
                    <label for="fileInput" class="upload-zone" id="uploadZone">
                        <div class="upload-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
                        </div>
                        <h4>Arrastra una imagen o haz clic para seleccionar</h4>
                        <p>PNG, JPG, WEBP — máx. 5 MB</p>
                        <input type="file" id="fileInput" accept="image/*" onchange="handleFiles(this.files)">
                        <div class="upload-tags" id="uploadTags">
                            <span class="upload-tag selected" data-tag="clase"   onclick="selectTag(this,event)">Para clase</span>
                            <span class="upload-tag"          data-tag="evento"  onclick="selectTag(this,event)">Para evento</span>
                            <span class="upload-tag"          data-tag="general" onclick="selectTag(this,event)">General</span>
                        </div>
                    </label>
                    <div style="padding:0 1.25rem 1.25rem;">
                        <div id="uploadPreview" style="display:none;">
                            <p style="font-size:.8rem;color:rgba(45,36,36,.5);margin-bottom:.5rem;">Vista previa:</p>
                            <img id="previewImg" style="width:100%;border-radius:.65rem;border:1px solid var(--light);display:block;" alt="Vista previa">
                            <div style="display:flex;gap:.5rem;margin-top:.75rem;">
                                <button class="btn btn-primary" style="flex:1" id="btnConfirmar" onclick="confirmarSubida()">
                                    <svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="width:13px;height:13px;"><polyline points="20 6 9 17 4 12"/></svg>
                                    Confirmar subida
                                </button>
                                <button class="btn btn-secondary" onclick="cancelarSubida()">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Biblioteca de imágenes</h2>
                        <span style="font-size:.8rem;color:rgba(45,36,36,.4);" id="imgCount">—</span>
                    </div>
                    <div class="img-grid" id="imgGrid"><div class="tbl-loading" style="grid-column:1/-1">Cargando...</div></div>
                </div>
            </div>
        </div>

        <!-- ══ RESERVAS ══ -->
        <div class="section" id="sec-reservas">
            <div class="sec-head">
                <div><h1>Reservas</h1><p>Gestiona las solicitudes de reserva del estudio.</p></div>
                <span id="reservas-pendientes-badge" style="display:none;background:rgba(212,175,55,.2);color:#92600a;font-size:.8rem;font-weight:500;padding:.4rem 1rem;border-radius:99px;"></span>
            </div>
            <!-- Filtros de estado -->
            <div style="display:flex;gap:.5rem;margin-bottom:1.25rem;flex-wrap:wrap;">
                <button class="btn btn-secondary btn-sm reserva-filter active" data-filter="todos"       onclick="filtrarReservas(this)">Todas</button>
                <button class="btn btn-secondary btn-sm reserva-filter"        data-filter="pendiente"   onclick="filtrarReservas(this)">Pendientes</button>
                <button class="btn btn-secondary btn-sm reserva-filter"        data-filter="confirmada"  onclick="filtrarReservas(this)">Confirmadas</button>
                <button class="btn btn-secondary btn-sm reserva-filter"        data-filter="cancelada"   onclick="filtrarReservas(this)">Canceladas</button>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Reservas</h2>
                    <span style="font-size:.8rem;color:rgba(45,36,36,.4);" id="reservas-count"></span>
                </div>
                <table class="tbl" id="tbl-reservas"><tr><td class="tbl-loading">Cargando...</td></tr></table>
            </div>
        </div>

    </main>
</div>

<!-- ══ MODAL CLASE ══ -->
<div class="modal-overlay" id="modalClase">
    <div class="modal">
        <div class="modal-header">
            <h3 id="modalClaseTitulo">Nueva clase</h3>
            <button class="modal-close" onclick="cerrarModal('modalClase')">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="form-grid">
            <div class="form-group">
                <label>Nombre de la clase *</label>
                <input type="text" id="c-nombre" placeholder="Ej. Piano Clásico">
            </div>
            <div class="form-group">
                <label>Profesor</label>
                <input type="text" id="c-profesor" placeholder="Prof. Nombre Apellido">
            </div>
            <div class="form-group">
                <label>Instrumento</label>
                <select id="c-instrumento">
                    <option value="piano">Piano</option>
                    <option value="guitarra">Guitarra</option>
                    <option value="canto">Canto</option>
                    <option value="ukulele">Ukulele</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nivel</label>
                <select id="c-nivel">
                    <option value="todos">Todos los niveles</option>
                    <option value="principiante">Principiante</option>
                    <option value="intermedio">Intermedio</option>
                    <option value="avanzado">Avanzado</option>
                </select>
            </div>
            <div class="form-group">
                <label>Duración (minutos)</label>
                <input type="number" id="c-duracion" value="60" min="15" max="180">
            </div>
            <div class="form-group">
                <label>Precio (MXN)</label>
                <input type="number" id="c-precio" value="200" min="0">
            </div>
            <div class="form-group">
                <label>Estado</label>
                <select id="c-estado">
                    <option value="activa">Activa</option>
                    <option value="borrador">Borrador</option>
                    <option value="inactiva">Inactiva</option>
                </select>
            </div>
            <div class="form-group full">
                <label>Imagen</label>
                <div class="img-input-wrap">
                    <input type="text" id="c-imagen" placeholder="https://... o pega una URL" oninput="syncPreview('c-imagen','c-img-prev-img','c-img-prev')">
                    <button type="button" class="btn-biblioteca" onclick="abrirPicker('c-imagen','c-img-prev-img','c-img-prev')">
                        <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        Biblioteca
                    </button>
                </div>
                <div class="img-preview-wrap" id="c-img-prev">
                    <img id="c-img-prev-img" src="" alt="">
                    <button type="button" class="img-preview-remove" onclick="quitarPreview('c-imagen','c-img-prev-img','c-img-prev')">✕</button>
                </div>
            </div>
            <div class="form-group full">
                <label>Descripción</label>
                <textarea id="c-descripcion" placeholder="Describe la clase brevemente..."></textarea>
            </div>
            <div class="form-group full">
                <label>Horarios</label>
                <div class="horarios-list" id="horariosList"></div>
                <button type="button" class="btn btn-secondary btn-sm" style="align-self:flex-start" onclick="agregarHorario()">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="width:12px;height:12px;"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Agregar horario
                </button>
            </div>
        </div>
        <div class="form-footer">
            <button class="btn btn-secondary" onclick="cerrarModal('modalClase')">Cancelar</button>
            <button class="btn btn-primary" id="btnGuardarClase" onclick="guardarClase()">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="width:13px;height:13px;"><polyline points="20 6 9 17 4 12"/></svg>
                Guardar clase
            </button>
        </div>
    </div>
</div>

<!-- ══ MODAL EVENTO ══ -->
<div class="modal-overlay" id="modalEvento">
    <div class="modal">
        <div class="modal-header">
            <h3 id="modalEventoTitulo">Nuevo evento</h3>
            <button class="modal-close" onclick="cerrarModal('modalEvento')">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="form-grid">
            <div class="form-group">
                <label>Nombre del evento *</label>
                <input type="text" id="e-nombre" placeholder="Ej. Concierto de primavera">
            </div>
            <div class="form-group">
                <label>Fecha *</label>
                <input type="date" id="e-fecha">
            </div>
            <div class="form-group">
                <label>Hora</label>
                <input type="time" id="e-hora" value="18:00">
            </div>
            <div class="form-group">
                <label>Lugar</label>
                <input type="text" id="e-lugar" placeholder="Ej. Sala principal">
            </div>
            <div class="form-group">
                <label>Precio de entrada</label>
                <input type="text" id="e-precio" placeholder="Gratis / $100">
            </div>
            <div class="form-group">
                <label>Estado</label>
                <select id="e-estado">
                    <option value="proximo">Próximo</option>
                    <option value="pasado">Pasado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>
            <div class="form-group full">
                <label>Descripción</label>
                <textarea id="e-descripcion" placeholder="Describe el evento..."></textarea>
            </div>
            <div class="form-group full">
                <label>Imagen</label>
                <div class="img-input-wrap">
                    <input type="text" id="e-imagen" placeholder="https://... o pega una URL" oninput="syncPreview('e-imagen','e-img-prev-img','e-img-prev')">
                    <button type="button" class="btn-biblioteca" onclick="abrirPicker('e-imagen','e-img-prev-img','e-img-prev')">
                        <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        Biblioteca
                    </button>
                </div>
                <div class="img-preview-wrap" id="e-img-prev">
                    <img id="e-img-prev-img" src="" alt="">
                    <button type="button" class="img-preview-remove" onclick="quitarPreview('e-imagen','e-img-prev-img','e-img-prev')">✕</button>
                </div>
            </div>
        </div>
        <div class="form-footer">
            <button class="btn btn-secondary" onclick="cerrarModal('modalEvento')">Cancelar</button>
            <button class="btn btn-primary" id="btnGuardarEvento" onclick="guardarEvento()">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="width:13px;height:13px;"><polyline points="20 6 9 17 4 12"/></svg>
                Guardar evento
            </button>
        </div>
    </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast">
    <svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
    <span id="toastMsg">Guardado correctamente.</span>
</div>

<script>
// ══════════════════════════════════════════════════════
//  CONFIGURACIÓN DE APIs
// ══════════════════════════════════════════════════════
const API = {
    clases:   'api/clases.php',
    eventos:  'api/eventos.php',
    imagenes: 'api/imagenes.php',
    reservas: 'api/reservas.php',
};

// ══════════════════════════════════════════════════════
//  ESTADO LOCAL (caché)
// ══════════════════════════════════════════════════════
let _clases   = [];
let _eventos  = [];
let _imagenes = [];
let _reservas = [];

let editandoClaseId  = null;
let editandoEventoId = null;
let tagSeleccionado  = 'clase';
let archivoPendiente = null;

// ══════════════════════════════════════════════════════
//  HELPERS
// ══════════════════════════════════════════════════════
function formatFecha(f) {
    if (!f) return '—';
    const [y,m,d] = f.split('-');
    const meses = ['','ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic'];
    return `${parseInt(d)} ${meses[parseInt(m)]} ${y}`;
}

function cap(s) { return s ? s.charAt(0).toUpperCase() + s.slice(1) : ''; }

const pillClase  = e => e==='activa'   ? '<span class="pill pill-green">Activa</span>'   : e==='borrador' ? '<span class="pill pill-amber">Borrador</span>' : '<span class="pill pill-gray">Inactiva</span>';
const pillEvento = e => e==='proximo'  ? '<span class="pill pill-green">Próximo</span>'  : e==='pasado'   ? '<span class="pill pill-gray">Pasado</span>'   : '<span class="pill pill-amber">Cancelado</span>';
const pillReserva= e => e==='confirmada'?'<span class="pill pill-green">Confirmada</span>': e==='cancelada'?'<span class="pill pill-gray">Cancelada</span>':'<span class="pill pill-amber">Pendiente</span>';

function setLoading(btnId, loading) {
    const btn = document.getElementById(btnId);
    if (!btn) return;
    btn.disabled = loading;
    if (loading) btn.innerHTML = `<span class="spinner"></span> Guardando...`;
}

// ══════════════════════════════════════════════════════
//  NAVEGACIÓN
// ══════════════════════════════════════════════════════
function goTo(sec, el) {
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    document.getElementById('sec-' + sec).classList.add('active');
    if (el) el.classList.add('active');
    const titulos = { inicio:'Panel de administración', clases:'Gestión de Clases', eventos:'Gestión de Eventos', imagenes:'Biblioteca de Imágenes', reservas:'Reservas' };
    document.getElementById('topbarSection').textContent = titulos[sec] || '';
}

// ══════════════════════════════════════════════════════
//  CARGA INICIAL (todas las APIs en paralelo)
// ══════════════════════════════════════════════════════
async function cargarTodo() {
    try {
        const [rClases, rEventos, rImagenes, rReservas] = await Promise.all([
            fetch(API.clases),
            fetch(API.eventos),
            fetch(API.imagenes),
            fetch(API.reservas),
        ]);
        _clases   = await rClases.json();
        _eventos  = await rEventos.json();
        _imagenes = await rImagenes.json();
        _reservas = await rReservas.json();
    } catch(err) {
        toast('Error al conectar con el servidor.', 'error');
    }
    renderTodo();
}

function renderTodo() {
    renderBadges();
    renderClases();
    renderEventos();
    renderImagenes();
    renderReservas();
    renderInicioClases();
    renderInicioEventos();
}

function renderBadges() {
    document.getElementById('badge-clases').textContent   = Array.isArray(_clases)   ? _clases.length   : '!';
    document.getElementById('badge-eventos').textContent  = Array.isArray(_eventos)  ? _eventos.length  : '!';
    document.getElementById('badge-imagenes').textContent = Array.isArray(_imagenes) ? _imagenes.length : '!';
    document.getElementById('badge-reservas').textContent = Array.isArray(_reservas) ? _reservas.length : '!';
    document.getElementById('stat-clases').textContent    = Array.isArray(_clases)   ? _clases.filter(c=>c.estado==='activa').length   : '—';
    document.getElementById('stat-eventos').textContent   = Array.isArray(_eventos)  ? _eventos.filter(e=>e.estado==='proximo').length : '—';
    document.getElementById('stat-reservas').textContent  = Array.isArray(_reservas) ? _reservas.filter(r=>r.estado==='pendiente').length : '—';
    document.getElementById('stat-imagenes').textContent  = Array.isArray(_imagenes) ? _imagenes.length : '—';
}

// ══════════════════════════════════════════════════════
//  RENDER CLASES
// ══════════════════════════════════════════════════════
function renderClases() {
    const t = document.getElementById('tbl-clases');
    if (!t) return;
    if (!Array.isArray(_clases) || _clases.length === 0) {
        t.innerHTML = `<tr><td class="tbl-empty" colspan="7">No hay clases registradas.</td></tr>`;
        return;
    }
    t.innerHTML = `<thead><tr><th>Clase</th><th>Instrumento</th><th>Nivel</th><th>Duración</th><th>Precio</th><th>Estado</th><th>Acciones</th></tr></thead><tbody>` +
        _clases.map(c => {
            const img = c.imagen_url
                ? `<img src="${c.imagen_url}" class="cell-thumb" alt="" onerror="this.style.display='none'">`
                : `<div class="cell-thumb"><svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg></div>`;
            return `<tr>
                <td><div class="cell-img">${img}<div><div class="cell-name">${c.nombre}</div><div class="cell-sub">${c.profesor??''}</div></div></div></td>
                <td class="tbl-muted" style="text-transform:capitalize">${c.instrumento??'—'}</td>
                <td class="tbl-muted" style="text-transform:capitalize">${c.nivel??'—'}</td>
                <td class="tbl-muted">${c.duracion??'—'} min</td>
                <td class="tbl-muted">$${Number(c.precio??0).toLocaleString('es-MX')}</td>
                <td>${pillClase(c.estado)}</td>
                <td><div class="row-actions">
                    <button class="btn btn-secondary btn-sm" onclick="editarClase(${c.id})">Editar</button>
                    <button class="btn btn-danger btn-sm"    onclick="eliminarClase(${c.id})">Eliminar</button>
                </div></td>
            </tr>`;
        }).join('') + `</tbody>`;
}

function renderInicioClases() {
    const t = document.getElementById('tbl-inicio-clases');
    if (!t || !Array.isArray(_clases)) return;
    if (_clases.length === 0) { t.innerHTML=`<tr><td class="tbl-empty">Sin clases.</td></tr>`; return; }
    t.innerHTML = `<thead><tr><th>Clase</th><th>Estado</th></tr></thead><tbody>` +
        _clases.slice(0,5).map(c => `<tr>
            <td><div class="cell-name">${c.nombre}</div><div class="cell-sub">${c.profesor??''}</div></td>
            <td>${pillClase(c.estado)}</td>
        </tr>`).join('') + `</tbody>`;
}

// ══════════════════════════════════════════════════════
//  CRUD CLASES
// ══════════════════════════════════════════════════════
function agregarHorario(dia='', hora='') {
    const dias = ['lunes','martes','miercoles','jueves','viernes','sabado','domingo'];
    const list = document.getElementById('horariosList');
    const row  = document.createElement('div');
    row.className = 'horario-row';
    row.innerHTML = `
        <select>${dias.map(d=>`<option value="${d}" ${d===dia?'selected':''}>${cap(d)}</option>`).join('')}</select>
        <input type="time" value="${hora}">
        <button type="button" class="btn-del-horario" onclick="this.parentElement.remove()">×</button>`;
    list.appendChild(row);
}

function abrirModalClase(id) {
    editandoClaseId = id || null;
    const c = id ? _clases.find(x => x.id === id) : null;
    document.getElementById('modalClaseTitulo').textContent = c ? 'Editar clase' : 'Nueva clase';
    document.getElementById('c-nombre').value      = c?.nombre      ?? '';
    document.getElementById('c-profesor').value    = c?.profesor    ?? '';
    document.getElementById('c-instrumento').value = c?.instrumento ?? 'piano';
    document.getElementById('c-nivel').value       = c?.nivel       ?? 'todos';
    document.getElementById('c-duracion').value    = c?.duracion    ?? 60;
    document.getElementById('c-precio').value      = c?.precio      ?? 200;
    document.getElementById('c-descripcion').value = c?.descripcion ?? '';
    document.getElementById('c-imagen').value      = c?.imagen_url  ?? '';
    syncPreview('c-imagen','c-img-prev-img','c-img-prev');
    document.getElementById('c-estado').value      = c?.estado      ?? 'activa';
    // Horarios
    document.getElementById('horariosList').innerHTML = '';
    const horarios = Array.isArray(c?.horarios) ? c.horarios : [];
    horarios.forEach(h => agregarHorario(h.dia_semana, h.hora?.substring(0,5)));
    // Restaurar botón
    const btn = document.getElementById('btnGuardarClase');
    btn.disabled = false;
    btn.innerHTML = `<svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="width:13px;height:13px;"><polyline points="20 6 9 17 4 12"/></svg> Guardar clase`;
    document.getElementById('modalClase').classList.add('open');
}

function editarClase(id) { abrirModalClase(id); }

async function guardarClase() {
    const nombre = document.getElementById('c-nombre').value.trim();
    if (!nombre) { toast('El nombre es obligatorio.', 'error'); return; }

    // Leer horarios del DOM
    const filas = document.getElementById('horariosList').querySelectorAll('.horario-row');
    const horarios = [];
    filas.forEach(fila => {
        const dia  = fila.querySelector('select').value;
        const hora = fila.querySelector('input[type=time]').value;
        if (dia && hora) horarios.push({ dia_semana: dia, hora });
    });

    const payload = {
        nombre,
        profesor:    document.getElementById('c-profesor').value.trim(),
        instrumento: document.getElementById('c-instrumento').value,
        nivel:       document.getElementById('c-nivel').value,
        duracion:    parseInt(document.getElementById('c-duracion').value) || 60,
        precio:      parseFloat(document.getElementById('c-precio').value) || 0,
        descripcion: document.getElementById('c-descripcion').value.trim(),
        imagen_url:  document.getElementById('c-imagen').value.trim(),
        estado:      document.getElementById('c-estado').value,
        horarios,
    };

    setLoading('btnGuardarClase', true);

    try {
        let res, data;
        if (editandoClaseId) {
            res  = await fetch(`${API.clases}?id=${editandoClaseId}`, { method:'PUT', headers:{'Content-Type':'application/json'}, body:JSON.stringify(payload) });
            data = await res.json();
        } else {
            res  = await fetch(API.clases, { method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(payload) });
            data = await res.json();
        }
        if (!res.ok || data.error) throw new Error(data.error || `Error ${res.status}`);
        toast(editandoClaseId ? 'Clase actualizada.' : 'Clase creada.', 'success');
        cerrarModal('modalClase');
        // Recargar clases
        const r = await fetch(API.clases);
        _clases = await r.json();
        renderClases();
        renderInicioClases();
        renderBadges();
    } catch(err) {
        toast('Error: ' + err.message, 'error');
        setLoading('btnGuardarClase', false);
        const btn = document.getElementById('btnGuardarClase');
        btn.innerHTML = `<svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="width:13px;height:13px;"><polyline points="20 6 9 17 4 12"/></svg> Guardar clase`;
    }
}

async function eliminarClase(id) {
    if (!confirm('¿Eliminar esta clase? También se eliminarán sus horarios.')) return;
    try {
        const res = await fetch(`${API.clases}?id=${id}`, { method:'DELETE' });
        const data = await res.json();
        if (!res.ok || data.error) throw new Error(data.error || `Error ${res.status}`);
        toast('Clase eliminada.', 'success');
        _clases = _clases.filter(c => c.id !== id);
        renderClases();
        renderInicioClases();
        renderBadges();
    } catch(err) {
        toast('Error al eliminar: ' + err.message, 'error');
    }
}

// ══════════════════════════════════════════════════════
//  RENDER EVENTOS
// ══════════════════════════════════════════════════════
function renderEventos() {
    const t = document.getElementById('tbl-eventos');
    if (!t) return;
    if (!Array.isArray(_eventos) || _eventos.length === 0) {
        t.innerHTML = `<tr><td class="tbl-empty" colspan="7">No hay eventos registrados.</td></tr>`;
        return;
    }
    t.innerHTML = `<thead><tr><th>Evento</th><th>Fecha</th><th>Hora</th><th>Lugar</th><th>Entrada</th><th>Estado</th><th>Acciones</th></tr></thead><tbody>` +
        _eventos.map(e => `<tr>
            <td><div class="cell-name">${e.nombre}</div><div class="cell-sub">${(e.descripcion??'').substring(0,50)}${(e.descripcion??'').length>50?'...':''}</div></td>
            <td class="tbl-muted">${formatFecha(e.fecha)}</td>
            <td class="tbl-muted">${e.hora ? e.hora.substring(0,5) : '—'}</td>
            <td class="tbl-muted">${e.lugar??'—'}</td>
            <td class="tbl-muted">${e.precio_entrada??'—'}</td>
            <td>${pillEvento(e.estado)}</td>
            <td><div class="row-actions">
                <button class="btn btn-secondary btn-sm" onclick="editarEvento(${e.id})">Editar</button>
                <button class="btn btn-danger btn-sm"    onclick="eliminarEvento(${e.id})">Eliminar</button>
            </div></td>
        </tr>`).join('') + `</tbody>`;
}

function renderInicioEventos() {
    const t = document.getElementById('tbl-inicio-eventos');
    if (!t || !Array.isArray(_eventos)) return;
    const proximos = _eventos.filter(e => e.estado === 'proximo');
    if (proximos.length === 0) { t.innerHTML=`<tr><td class="tbl-empty">Sin próximos eventos.</td></tr>`; return; }
    t.innerHTML = `<thead><tr><th>Evento</th><th>Fecha</th></tr></thead><tbody>` +
        proximos.slice(0,5).map(e => `<tr>
            <td><div class="cell-name">${e.nombre}</div><div class="cell-sub">${e.lugar??''}</div></td>
            <td class="tbl-muted" style="white-space:nowrap">${formatFecha(e.fecha)}</td>
        </tr>`).join('') + `</tbody>`;
}

// ══════════════════════════════════════════════════════
//  CRUD EVENTOS
// ══════════════════════════════════════════════════════
function abrirModalEvento(id) {
    editandoEventoId = id || null;
    const e = id ? _eventos.find(x => x.id === id) : null;
    document.getElementById('modalEventoTitulo').textContent = e ? 'Editar evento' : 'Nuevo evento';
    document.getElementById('e-nombre').value      = e?.nombre         ?? '';
    document.getElementById('e-fecha').value       = e?.fecha          ?? '';
    document.getElementById('e-hora').value        = e?.hora?.substring(0,5) ?? '18:00';
    document.getElementById('e-lugar').value       = e?.lugar          ?? '';
    document.getElementById('e-precio').value      = e?.precio_entrada ?? '';
    document.getElementById('e-descripcion').value = e?.descripcion    ?? '';
    document.getElementById('e-imagen').value      = e?.imagen_url     ?? '';
    syncPreview('e-imagen','e-img-prev-img','e-img-prev');
    document.getElementById('e-estado').value      = e?.estado         ?? 'proximo';
    const btn = document.getElementById('btnGuardarEvento');
    btn.disabled = false;
    btn.innerHTML = `<svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="width:13px;height:13px;"><polyline points="20 6 9 17 4 12"/></svg> Guardar evento`;
    document.getElementById('modalEvento').classList.add('open');
}

function editarEvento(id) { abrirModalEvento(id); }

async function guardarEvento() {
    const nombre = document.getElementById('e-nombre').value.trim();
    const fecha  = document.getElementById('e-fecha').value;
    if (!nombre || !fecha) { toast('Nombre y fecha son obligatorios.', 'error'); return; }

    const payload = {
        nombre,
        fecha,
        hora:           document.getElementById('e-hora').value,
        lugar:          document.getElementById('e-lugar').value.trim(),
        precio_entrada: document.getElementById('e-precio').value.trim(),
        descripcion:    document.getElementById('e-descripcion').value.trim(),
        imagen_url:     document.getElementById('e-imagen').value.trim(),
        estado:         document.getElementById('e-estado').value,
    };

    setLoading('btnGuardarEvento', true);

    try {
        let res, data;
        if (editandoEventoId) {
            res  = await fetch(`${API.eventos}?id=${editandoEventoId}`, { method:'PUT', headers:{'Content-Type':'application/json'}, body:JSON.stringify(payload) });
            data = await res.json();
        } else {
            res  = await fetch(API.eventos, { method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(payload) });
            data = await res.json();
        }
        if (!res.ok || data.error) throw new Error(data.error || `Error ${res.status}`);
        toast(editandoEventoId ? 'Evento actualizado.' : 'Evento creado.', 'success');
        cerrarModal('modalEvento');
        const r = await fetch(API.eventos);
        _eventos = await r.json();
        renderEventos();
        renderInicioEventos();
        renderBadges();
    } catch(err) {
        toast('Error: ' + err.message, 'error');
        setLoading('btnGuardarEvento', false);
        const btn = document.getElementById('btnGuardarEvento');
        btn.innerHTML = `<svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="width:13px;height:13px;"><polyline points="20 6 9 17 4 12"/></svg> Guardar evento`;
    }
}

async function eliminarEvento(id) {
    if (!confirm('¿Eliminar este evento?')) return;
    try {
        const res  = await fetch(`${API.eventos}?id=${id}`, { method:'DELETE' });
        const data = await res.json();
        if (!res.ok || data.error) throw new Error(data.error || `Error ${res.status}`);
        toast('Evento eliminado.', 'success');
        _eventos = _eventos.filter(e => e.id !== id);
        renderEventos();
        renderInicioEventos();
        renderBadges();
    } catch(err) {
        toast('Error al eliminar: ' + err.message, 'error');
    }
}

// ══════════════════════════════════════════════════════
//  IMÁGENES — subida real con multipart/form-data
// ══════════════════════════════════════════════════════
function renderImagenes() {
    const grid  = document.getElementById('imgGrid');
    const count = document.getElementById('imgCount');
    if (!grid) return;
    if (!Array.isArray(_imagenes) || _imagenes.length === 0) {
        count.textContent = '0 imágenes';
        grid.innerHTML = `<div class="empty-state" style="grid-column:1/-1">
            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            <p>Aún no hay imágenes subidas.</p>
        </div>`;
        return;
    }
    count.textContent = `${_imagenes.length} imagen${_imagenes.length !== 1 ? 'es' : ''}`;
    grid.innerHTML = _imagenes.map(img => `
        <div class="img-item">
            <img src="${img.url}" alt="${img.nombre}" onerror="this.src=''">
            <div class="img-item-overlay">
                <button class="del-img" onclick="eliminarImagen(${img.id})">Eliminar</button>
            </div>
            <div class="img-label">${img.tag ?? ''}</div>
        </div>`).join('');
}

function selectTag(el, ev) {
    ev && ev.preventDefault();
    document.querySelectorAll('.upload-tag').forEach(t => t.classList.remove('selected'));
    el.classList.add('selected');
    tagSeleccionado = el.dataset.tag;
}

function handleFiles(files) {
    if (!files || files.length === 0) return;
    const file = files[0];
    if (file.size > 5 * 1024 * 1024) { toast('La imagen supera los 5 MB.', 'error'); return; }
    archivoPendiente = file;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('uploadPreview').style.display = 'block';
    };
    reader.readAsDataURL(file);
}

async function confirmarSubida() {
    if (!archivoPendiente) return;
    const btn = document.getElementById('btnConfirmar');
    btn.disabled = true;
    btn.innerHTML = `<span class="spinner"></span> Subiendo...`;

    const formData = new FormData();
    formData.append('imagen', archivoPendiente);
    formData.append('tag', tagSeleccionado);

    try {
        const res  = await fetch(API.imagenes, { method:'POST', body:formData });
        const data = await res.json();
        if (!res.ok || data.error) throw new Error(data.error || `Error ${res.status}`);
        toast('Imagen subida correctamente.', 'success');
        cancelarSubida();
        // Recargar imágenes
        const r = await fetch(API.imagenes);
        _imagenes = await r.json();
        renderImagenes();
        renderBadges();
    } catch(err) {
        toast('Error al subir: ' + err.message, 'error');
        btn.disabled = false;
        btn.innerHTML = `<svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="width:13px;height:13px;"><polyline points="20 6 9 17 4 12"/></svg> Confirmar subida`;
    }
}

function cancelarSubida() {
    archivoPendiente = null;
    document.getElementById('uploadPreview').style.display = 'none';
    document.getElementById('fileInput').value = '';
    const btn = document.getElementById('btnConfirmar');
    if (btn) { btn.disabled=false; btn.innerHTML=`<svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="width:13px;height:13px;"><polyline points="20 6 9 17 4 12"/></svg> Confirmar subida`; }
}

async function eliminarImagen(id) {
    if (!confirm('¿Eliminar esta imagen? Se borrará del servidor.')) return;
    try {
        const res  = await fetch(`${API.imagenes}?id=${id}`, { method:'DELETE' });
        const data = await res.json();
        if (!res.ok || data.error) throw new Error(data.error || `Error ${res.status}`);
        toast('Imagen eliminada.', 'success');
        _imagenes = _imagenes.filter(i => i.id !== id);
        renderImagenes();
        renderBadges();
    } catch(err) {
        toast('Error al eliminar: ' + err.message, 'error');
    }
}

// Drag & drop
const zone = document.getElementById('uploadZone');
if (zone) {
    zone.addEventListener('dragover', e => { e.preventDefault(); zone.style.borderColor='var(--brown)'; });
    zone.addEventListener('dragleave', () => { zone.style.borderColor=''; });
    zone.addEventListener('drop', e => { e.preventDefault(); zone.style.borderColor=''; handleFiles(e.dataTransfer.files); });
}

// ══════════════════════════════════════════════════════
//  RESERVAS
// ══════════════════════════════════════════════════════
let _filtroReserva = 'todos';

function filtrarReservas(btn) {
    document.querySelectorAll('.reserva-filter').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    _filtroReserva = btn.dataset.filter;
    renderReservas();
}

function renderReservas() {
    const t = document.getElementById('tbl-reservas');
    if (!t || !Array.isArray(_reservas)) return;

    // Badge de pendientes en el header de sección
    const pendientes = _reservas.filter(r => r.estado === 'pendiente').length;
    const badge = document.getElementById('reservas-pendientes-badge');
    if (pendientes > 0) {
        badge.textContent = `${pendientes} pendiente${pendientes > 1 ? 's' : ''}`;
        badge.style.display = 'inline-block';
    } else {
        badge.style.display = 'none';
    }

    const filtradas = _filtroReserva === 'todos'
        ? _reservas
        : _reservas.filter(r => r.estado === _filtroReserva);

    document.getElementById('reservas-count').textContent =
        `${filtradas.length} reserva${filtradas.length !== 1 ? 's' : ''}`;

    if (filtradas.length === 0) {
        t.innerHTML = `<tr><td class="tbl-empty" colspan="7">No hay reservas${_filtroReserva !== 'todos' ? ' con este estado' : ''}.</td></tr>`;
        return;
    }

    t.innerHTML = `<thead><tr>
        <th>Alumno</th><th>Correo</th><th>Clase</th>
        <th>Fecha</th><th>Hora</th><th>Estado</th><th>Acciones</th>
    </tr></thead><tbody>` +
        filtradas.map(r => {
            const estado = r.estado ?? 'pendiente';
            // Botones según estado actual
            let acciones = '';
            if (estado === 'pendiente') {
                acciones = `
                    <button class="btn btn-aceptar btn-sm"  onclick="cambiarEstadoReserva(${r.id},'confirmada')">✓ Aceptar</button>
                    <button class="btn btn-rechazar btn-sm" onclick="cambiarEstadoReserva(${r.id},'cancelada')">✕ Rechazar</button>`;
            } else if (estado === 'confirmada') {
                acciones = `
                    <button class="btn btn-rechazar btn-sm" onclick="cambiarEstadoReserva(${r.id},'cancelada')">✕ Cancelar</button>`;
            } else if (estado === 'cancelada') {
                acciones = `
                    <button class="btn btn-aceptar btn-sm" onclick="cambiarEstadoReserva(${r.id},'confirmada')">↩ Reactivar</button>`;
            }
            return `<tr>
                <td><div class="cell-name">${r.alumno_nombre??''} ${r.alumno_apellido??''}</div>
                    <div class="cell-sub">${r.alumno_tel ? r.alumno_tel : ''}</div></td>
                <td class="tbl-muted">${r.alumno_correo??'—'}</td>
                <td class="tbl-muted">${r.clase_nombre??'—'}<div class="cell-sub">${r.dia_semana ? cap(r.dia_semana) : ''}</div></td>
                <td class="tbl-muted">${formatFecha(r.fecha)}</td>
                <td class="tbl-muted">${r.hora ? r.hora.substring(0,5) : '—'}</td>
                <td>${pillReserva(estado)}</td>
                <td><div class="row-actions">${acciones}</div></td>
            </tr>`;
        }).join('') + `</tbody>`;
}

async function cambiarEstadoReserva(id, nuevoEstado) {
    const etiquetas = { confirmada:'aceptar', cancelada:'rechazar/cancelar', pendiente:'marcar como pendiente' };
    if (!confirm(`¿Deseas ${etiquetas[nuevoEstado] ?? nuevoEstado} esta reserva?`)) return;
    try {
        const res  = await fetch(`${API.reservas}?id=${id}`, {
            method:  'PUT',
            headers: { 'Content-Type': 'application/json' },
            body:    JSON.stringify({ estado: nuevoEstado }),
        });
        const data = await res.json();
        if (!res.ok || data.error) throw new Error(data.error || `Error ${res.status}`);

        // Actualizar caché local sin recargar toda la lista
        const idx = _reservas.findIndex(r => r.id === id);
        if (idx !== -1) _reservas[idx].estado = nuevoEstado;

        const msgs = { confirmada:'Reserva aceptada ✓', cancelada:'Reserva rechazada.', pendiente:'Reserva marcada como pendiente.' };
        toast(msgs[nuevoEstado] ?? 'Estado actualizado.', nuevoEstado === 'confirmada' ? 'success' : 'error');
        renderReservas();
        renderBadges();
    } catch(err) {
        toast('Error: ' + err.message, 'error');
    }
}

// ══════════════════════════════════════════════════════
//  MODALES
// ══════════════════════════════════════════════════════
function cerrarModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-overlay').forEach(m => {
    m.addEventListener('click', e => { if (e.target === m) cerrarModal(m.id); });
});

// ══════════════════════════════════════════════════════
//  TOAST
// ══════════════════════════════════════════════════════
let toastTimer;
function toast(msg, tipo = 'success') {
    const t = document.getElementById('toast');
    document.getElementById('toastMsg').textContent = msg;
    t.className = `toast ${tipo}`;
    setTimeout(() => t.classList.add('show'), 10);
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => t.classList.remove('show'), 3500);
}

// ══════════════════════════════════════════════════════
//  BIBLIOTECA PICKER
// ══════════════════════════════════════════════════════
let _pickerInput = null;
let _pickerImg   = null;
let _pickerWrap  = null;

function abrirPicker(inputId, imgId, wrapId) {
    _pickerInput = inputId;
    _pickerImg   = imgId;
    _pickerWrap  = wrapId;

    const content = document.getElementById('pickerContent');

    if (!Array.isArray(_imagenes) || _imagenes.length === 0) {
        content.innerHTML = `<div style="text-align:center;padding:3rem 1rem;">
            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="width:2.5rem;height:2.5rem;margin:0 auto .75rem;display:block;opacity:.25;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            <p style="font-size:.9rem;color:rgba(45,36,36,.4);">No hay imágenes en la biblioteca.</p>
            <p style="font-size:.8rem;color:rgba(45,36,36,.35);margin-top:.35rem;">Ve a <strong>Imágenes</strong> para subir una primero.</p>
        </div>`;
    } else {
        content.innerHTML = `<div class="bib-grid">${
            _imagenes.map(img => `
                <div class="bib-item" onclick="seleccionarImagen('${img.url.replace(/'/g,"\\'")}')">
                    <img src="${img.url}" alt="${img.nombre}" loading="lazy">
                    <div class="bib-item-label">${img.tag ?? ''}</div>
                    <div class="bib-item-check">
                        <svg fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="width:10px;height:10px;"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                </div>`).join('')
        }</div>`;
    }

    document.getElementById('modalPicker').classList.add('open');
}

function seleccionarImagen(url) {
    if (!_pickerInput) return;
    document.getElementById(_pickerInput).value = url;
    const imgEl  = document.getElementById(_pickerImg);
    const wrapEl = document.getElementById(_pickerWrap);
    imgEl.src = url;
    wrapEl.style.display = 'block';
    cerrarModal('modalPicker');
}

function syncPreview(inputId, imgId, wrapId) {
    const url  = document.getElementById(inputId).value.trim();
    const wrap = document.getElementById(wrapId);
    const img  = document.getElementById(imgId);
    if (url) { img.src = url; wrap.style.display = 'block'; }
    else     { wrap.style.display = 'none'; }
}

function quitarPreview(inputId, imgId, wrapId) {
    document.getElementById(inputId).value = '';
    document.getElementById(imgId).src     = '';
    document.getElementById(wrapId).style.display = 'none';
}

// ══════════════════════════════════════════════════════
//  INIT
// ══════════════════════════════════════════════════════
cargarTodo();
</script>
<!-- ══ MODAL BIBLIOTECA PICKER ══ -->
<div class="modal-overlay" id="modalPicker" style="z-index:600;">
    <div class="modal" style="max-width:48rem;">
        <div class="modal-header">
            <div>
                <h3>Seleccionar imagen</h3>
                <p style="font-size:.8rem;color:rgba(45,36,36,.5);margin-top:.15rem;">Haz clic en una imagen para usarla.</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalPicker')">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div id="pickerContent"></div>
        <div style="padding:.75rem 1.25rem;border-top:1px solid var(--light);display:flex;justify-content:flex-end;">
            <button class="btn btn-secondary" onclick="cerrarModal('modalPicker')">Cancelar</button>
        </div>
    </div>
</div>

</body>
</html>