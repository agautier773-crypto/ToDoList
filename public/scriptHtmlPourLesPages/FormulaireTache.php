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
    .btn-violet { background: var(--violet); color: #fff; border: none; }
    .btn-violet:hover { background: #5a38cc; color: #fff; }
    .btn-outline-c { color: var(--cyan); border: 1px solid var(--cyan); background: transparent; }
    .btn-outline-c:hover { background: var(--cyan); color: #0E0C1E; }

    /* FORM CARD */
    .form-card {
        background: #16132E;
        border: 1px solid rgba(255,255,255,0.09);
        border-radius: 16px;
        padding: 2.2rem;
    }

    /* LABELS */
    .form-label { color: rgba(200,197,255,0.8); font-size: .88rem; font-weight: 500; margin-bottom: .4rem; }

    /* INPUTS */
    .form-control, .form-select {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        color: #E8E6FF;
        font-size: .9rem;
        padding: .65rem .9rem;
    }
    .form-control:focus, .form-select:focus {
        background: rgba(255,255,255,0.07);
        border-color: var(--violet);
        box-shadow: 0 0 0 3px rgba(112,72,233,0.2);
        color: #E8E6FF;
        outline: none;
    }
    .form-control::placeholder { color: rgba(200,197,255,0.3); }

    /* SELECT options */
    .form-select option { background: #1a1440; color: #E8E6FF; }

    /* STATUT BADGE (lecture seule) */
    .statut-display {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: .65rem .9rem;
        display: flex; align-items: center; gap: .6rem;
        font-size: .9rem; color: rgba(200,197,255,.55);
    }
    .statut-dot {
        width: 8px; height: 8px; border-radius: 50%;
        background: rgba(200,197,255,0.3);
        border: 1px solid rgba(200,197,255,0.4);
    }
    .statut-badge {
        font-size: .72rem; padding: .2rem .7rem;
        border-radius: 50px; font-weight: 500;
        background: rgba(255,255,255,0.07);
        color: rgba(200,197,255,0.55);
        border: 1px solid rgba(255,255,255,0.1);
        margin-left: auto;
    }
    .info-text { font-size: .75rem; color: rgba(200,197,255,0.35); margin-top: .35rem; }

    /* DATE */
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(0.6) sepia(1) saturate(2) hue-rotate(180deg);
        cursor: pointer;
    }

    /* DIVIDER */
    .form-divider { border-color: rgba(255,255,255,0.08); margin: 1.5rem 0; }

    /* FOOTER */
    footer { background: #16132E; border-top: 1px solid rgba(255,255,255,0.07); font-size: .82rem; color: rgba(200,197,255,.35); }
    footer span { color: var(--cyan); }
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

<!-- CONTENU -->
<div class="container py-5" style="max-width: 620px;">

    <!-- En-tête -->
    <div class="mb-4">
        <a href="#" class="text-decoration-none d-inline-flex align-items-center gap-2 mb-3" style="color:rgba(200,197,255,.5);font-size:.85rem;">
            <i class="bi bi-arrow-left"></i> Retour à mes tâches
        </a>
        <h1 class="fw-bold mb-1" style="font-size:1.8rem;">Nouvelle tâche</h1>
        <p style="color:rgba(200,197,255,.5);font-size:.9rem;">Remplissez les informations ci-dessous pour créer votre tâche.</p>
    </div>

    <!-- Formulaire -->
    <div class="form-card">
        <form>

            <!-- Titre -->
            <div class="mb-3">
                <label class="form-label">Titre <span style="color:var(--cyan)">*</span></label>
                <input type="text" class="form-control" placeholder="Ex : Payer la facture EDF" />
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" rows="3" placeholder="Ajoutez des détails sur cette tâche…"></textarea>
            </div>

            <hr class="form-divider" />

            <!-- Dates -->
            <div class="row g-3 mb-3">
                <div class="col-6">
                    <label class="form-label">Date de création <span style="color:var(--cyan)">*</span></label>
                    <input type="date" class="form-control" id="dateCreation" />
                </div>
                <div class="col-6">
                    <label class="form-label">Date de fin</label>
                    <input type="date" class="form-control" />
                </div>
            </div>

            <hr class="form-divider" />

            <!-- Statut (automatique) -->
            <div class="mb-3">
                <label class="form-label">Statut</label>
                <div class="statut-display">
                    <div class="statut-dot"></div>
                    <span>Défini automatiquement à la création</span>
                    <span class="statut-badge">⭕ Pas commencé</span>
                </div>
                <div class="info-text"><i class="bi bi-info-circle me-1"></i>Le statut pourra être modifié après la création de la tâche.</div>
            </div>

            <!-- Catégorie -->
            <div class="mb-4">
                <label class="form-label">Catégorie <span style="color:var(--cyan)">*</span></label>
                <select class="form-select">
                    <option value="" disabled selected>Choisir une catégorie…</option>
                    <option value="eco">💰 Économique</option>
                    <option value="home">🏠 Ménagère</option>
                    <option value="work">💼 Professionnelle</option>
                    <option value="perso">🌱 Personnelle</option>
                </select>
            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-violet px-4 flex-grow-1">
                    <i class="bi bi-plus-circle me-2"></i>Créer la tâche
                </button>
                <a href="#" class="btn btn-outline-c px-4">Annuler</a>
            </div>

        </form>
    </div>
</div>

