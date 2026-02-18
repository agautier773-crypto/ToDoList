<style>
    :root {
        --violet: #7048E9;
        --cyan:   #1AF3D9;
        --sky:    #7EB5D8;
        --blue:   #406DCF;
    }
    body { background: #0E0C1E; color: #E8E6FF; font-family: 'Segoe UI', sans-serif; }

    /* NAV */
    .navbar { background: #16132E; border-bottom: 1px solid rgba(255,255,255,0.08); }
    .navbar-brand { color: var(--cyan) !important; font-weight: 700; font-size: 1.3rem; }
    .btn-violet  { background: var(--violet); color: #fff; border: none; }
    .btn-violet:hover  { background: #5a38cc; color: #fff; }
    .btn-outline-c { color: var(--cyan); border: 1px solid var(--cyan); background: transparent; }
    .btn-outline-c:hover { background: var(--cyan); color: #0E0C1E; }

    /* HERO */
    .hero { background: linear-gradient(135deg, #16132E 0%, #1a1440 100%); padding: 5rem 0; }
    .hero h1 { font-size: 2.4rem; font-weight: 800; }
    .hero h1 span { color: var(--cyan); }
    .hero p { color: rgba(200,197,255,0.65); }

    /* CARDS */
    .card-dark {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.09);
        border-radius: 14px;
    }
    .card-dark:hover { border-color: var(--violet); }

    /* TÂCHES */
    .task-row { padding: .65rem .9rem; border-radius: 10px; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); }
    .badge-done  { background: rgba(26,243,217,0.15);  color: var(--cyan); font-size: .7rem; }
    .badge-going { background: rgba(126,181,216,0.15); color: var(--sky);  font-size: .7rem; }
    .badge-todo  { background: rgba(255,255,255,0.07); color: rgba(200,197,255,0.55); font-size: .7rem; }

    /* STATUTS */
    .status-todo  { border: 1px solid rgba(200,197,255,0.12); background: rgba(255,255,255,0.03); border-radius: 12px; padding: 1.4rem; }
    .status-going { border: 1px solid rgba(64,109,207,0.3);   background: rgba(64,109,207,0.07);  border-radius: 12px; padding: 1.4rem; }
    .status-done  { border: 1px solid rgba(26,243,217,0.3);   background: rgba(26,243,217,0.06);  border-radius: 12px; padding: 1.4rem; }

    /* CTA */
    .cta { background: linear-gradient(135deg, rgba(112,72,233,0.2), rgba(64,109,207,0.15)); border-top: 1px solid rgba(112,72,233,0.2); }

    footer { background: #16132E; border-top: 1px solid rgba(255,255,255,0.07); font-size: .82rem; color: rgba(200,197,255,.35); }
    footer span { color: var(--cyan); }

    .section-label { color: var(--cyan); font-size: .75rem; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; }
</style>
</head>
<body>

<!-- NAV -->
<nav class="navbar">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="#"><i class="bi bi-check2-square me-2"></i>ToDoList</a>
        <div class="d-flex gap-2">
            <a href="#" class="btn btn-outline-c btn-sm px-3">Se connecter</a>
            <a href="#" class="btn btn-violet btn-sm px-3">S'inscrire</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero text-center">
    <div class="container" style="max-width:620px">
        <h1>Organisez vos tâches,<br/><span>sans prise de tête.</span></h1>
        <p class="mt-3 mb-4">Classez par catégorie, suivez l'état de chaque tâche, et avancez sereinement au quotidien.</p>
        <div class="d-flex gap-3 justify-content-center">
            <a href="#" class="btn btn-violet px-4"><i class="bi bi-rocket-takeoff me-2"></i>Commencer gratuitement</a>
            <a href="#" class="btn btn-outline-c px-4">Se connecter</a>
        </div>
    </div>
</section>

<!-- CATÉGORIES -->
<section class="py-5" style="background:rgba(255,255,255,.02);border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)">
    <div class="container" style="max-width:720px">
        <p class="section-label text-center mb-2"><i class="bi bi-grid me-1"></i>Catégories</p>
        <h2 class="text-center fw-bold mb-4" style="font-size:1.6rem;">Un espace pour chaque domaine</h2>
        <div class="row g-3 text-center">
            <div class="col-6 col-md-3">
                <div class="card-dark p-3 h-100">
                    <div style="font-size:2rem;">💰</div>
                    <div class="fw-600 mt-2" style="font-size:.9rem;">Économique</div>
                    <div style="font-size:.75rem;color:rgba(200,197,255,.5);">Factures, budget…</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card-dark p-3 h-100">
                    <div style="font-size:2rem;">🏠</div>
                    <div class="fw-600 mt-2" style="font-size:.9rem;">Ménagère</div>
                    <div style="font-size:.75rem;color:rgba(200,197,255,.5);">Courses, entretien…</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card-dark p-3 h-100">
                    <div style="font-size:2rem;">💼</div>
                    <div class="fw-600 mt-2" style="font-size:.9rem;">Professionnelle</div>
                    <div style="font-size:.75rem;color:rgba(200,197,255,.5);">Projets, réunions…</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card-dark p-3 h-100">
                    <div style="font-size:2rem;">🌱</div>
                    <div class="fw-600 mt-2" style="font-size:.9rem;">Personnelle</div>
                    <div style="font-size:.75rem;color:rgba(200,197,255,.5);">Sport, loisirs…</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ÉTATS -->
<section class="py-5">
    <div class="container" style="max-width:720px">
        <p class="section-label text-center mb-2"><i class="bi bi-arrow-repeat me-1"></i>États des tâches</p>
        <h2 class="text-center fw-bold mb-4" style="font-size:1.6rem;">Suivez chaque étape</h2>
        <div class="row g-3 text-center">
            <div class="col-md-4">
                <div class="status-todo h-100">
                    <div style="font-size:2rem;">⭕</div>
                    <div class="fw-bold mt-2">Pas commencé</div>
                    <p style="font-size:.82rem;color:rgba(200,197,255,.55);margin-top:.4rem;">Tâche planifiée, en attente de démarrage.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="status-going h-100">
                    <div style="font-size:2rem;">🔵</div>
                    <div class="fw-bold mt-2" style="color:var(--sky)">En cours</div>
                    <p style="font-size:.82rem;color:rgba(200,197,255,.55);margin-top:.4rem;">Tâche active, vous travaillez dessus.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="status-done h-100">
                    <div style="font-size:2rem;">✅</div>
                    <div class="fw-bold mt-2" style="color:var(--cyan)">Terminé</div>
                    <p style="font-size:.82rem;color:rgba(200,197,255,.55);margin-top:.4rem;">Tâche accomplie et archivée.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta py-5 text-center">
    <div class="container">
        <h2 class="fw-bold mb-3">Prêt à vous organiser ?</h2>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="#" class="btn btn-violet px-4"><i class="bi bi-person-plus me-2"></i>Créer un compte</a>
            <a href="#" class="btn btn-outline-c px-4">Se connecter</a>
        </div>
    </div>
</section>
