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

    /* DETAIL CARD */
    .detail-card {
        background: #16132E;
        border: 1px solid rgba(255,255,255,0.09);
        border-radius: 16px;
        overflow: hidden;
    }

    .detail-card-header {
        padding: 1.5rem 1.8rem;
        border-bottom: 1px solid rgba(255,255,255,0.08);
        display: flex; align-items: flex-start; justify-content: space-between; gap: 1rem;
    }

    .task-title-main { font-size: 1.4rem; font-weight: 700; margin-bottom: .3rem; }

    .cat-chip {
        font-size: .75rem; padding: .25rem .8rem; border-radius: 50px; font-weight: 500;
        background: rgba(126,181,216,0.12); color: var(--sky);
    }

    /* STATUT BADGES */
    .badge-done  { background: rgba(26,243,217,0.12);  color: var(--cyan); border: 1px solid rgba(26,243,217,0.25);  font-size: .78rem; }
    .badge-going { background: rgba(126,181,216,0.12); color: var(--sky);  border: 1px solid rgba(126,181,216,0.25); font-size: .78rem; }
    .badge-todo  { background: rgba(255,255,255,0.06); color: rgba(200,197,255,0.55); border: 1px solid rgba(255,255,255,0.1); font-size: .78rem; }

    /* FIELDS */
    .detail-body { padding: 1.5rem 1.8rem; }

    .field-row {
        display: flex; gap: 1rem; align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .field-row:last-child { border-bottom: none; }

    .field-icon {
        width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center; font-size: 1rem;
        background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);
    }
    .field-label { font-size: .75rem; color: rgba(200,197,255,.45); margin-bottom: .25rem; text-transform: uppercase; letter-spacing: .06em; }
    .field-value { font-size: .95rem; color: #E8E6FF; line-height: 1.6; }

    /* DATES inline */
    .dates-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .date-block {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 12px; padding: .9rem 1.1rem;
    }
    .date-label { font-size: .72rem; color: rgba(200,197,255,.45); text-transform: uppercase; letter-spacing: .06em; margin-bottom: .3rem; }
    .date-value { font-size: .95rem; font-weight: 600; }

    /* ACTION BUTTONS */
    .detail-footer {
        padding: 1.2rem 1.8rem;
        border-top: 1px solid rgba(255,255,255,0.08);
        display: flex; gap: .75rem; justify-content: flex-end;
    }
    .btn-action {
        border-radius: 8px; font-size: .82rem; padding: .45rem .9rem;
        display: inline-flex; align-items: center; gap: .4rem; cursor: pointer;
    }
    .btn-edit   { background: rgba(64,109,207,0.15); color: var(--sky);  border: 1px solid rgba(64,109,207,0.25); }
    .btn-edit:hover   { background: rgba(64,109,207,0.3); color: #fff; }
    .btn-delete { background: rgba(255,80,80,0.1);  color: #FF8080; border: 1px solid rgba(255,80,80,0.2); }
    .btn-delete:hover { background: rgba(255,80,80,0.25); color: #fff; }

    footer { background: #16132E; border-top: 1px solid rgba(255,255,255,0.07); font-size: .82rem; color: rgba(200,197,255,.35); }
    footer span { color: var(--cyan); }
</style>
</head>
<body>


<!-- CONTENU -->
<div class="container py-5" style="max-width: 620px;">

    <!-- Retour -->
    <a href="/tache" class="text-decoration-none d-inline-flex align-items-center gap-2 mb-4" style="color:rgba(200,197,255,.5);font-size:.85rem;">
        <i class="bi bi-arrow-left"></i> Retour à mes tâches
    </a>

    <!-- Carte détail -->
    <div class="detail-card">

        <!-- En-tête -->
        <div class="detail-card-header">
            <div>
                <div class="task-title-main"><?=$tache->titre?></div>
                <span class="cat-chip"><?=$tache->getNameCategorie()?></span>
            </div>
            <span class="badge badge-going rounded-pill px-3 py-2"><?=$tache->statut?></span>
        </div>

        <!-- Corps -->
        <div class="detail-body">

            <!-- Description -->
            <div class="field-row">
                <div class="field-icon"><i class="bi bi-text-left" style="color:var(--sky)"></i></div>
                <div>
                    <div class="field-label">Description</div>
                    <div class="field-value"><?=$tache->description?></div>
                </div>
            </div>

            <!-- Dates -->
            <div class="field-row">
                <div class="field-icon"><i class="bi bi-calendar3" style="color:var(--violet)"></i></div>
                <div class="flex-grow-1">
                    <div class="field-label">Dates</div>
                    <div class="dates-row mt-2">
                        <div class="date-block">
                            <div class="date-label">Date de création</div>
                            <div class="date-value"><?=$tache->date_creation?></div>
                        </div>
                        <div class="date-block">
                            <div class="date-label">Date de fin</div>
                            <div class="date-value" style="color:var(--cyan);"><?=$tache->date_fin?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statut -->
            <div class="field-row">
                <div class="field-icon"><i class="bi bi-arrow-repeat" style="color:var(--cyan)"></i></div>
                <div>
                    <div class="field-label">Statut</div>
                    <div class="mt-2 d-flex gap-2">
                        <span class="badge badge-todo rounded-pill px-3 py-2"><?=$tache->statut?></span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer actions -->
        <div class="detail-footer">
            <a href="/tache/update/<?=$tache->id?>" class="btn-action btn-edit"><i class="bi bi-pencil"></i> Modifier</a>
            <a href="/tache/delete/<?=$tache->id?>" class="btn-action btn-delete"><i class="bi bi-trash"></i> Supprimer</a>
        </div>

    </div>
</div>
