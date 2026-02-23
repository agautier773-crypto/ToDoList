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

    /* CATEGORIE HEADER */
    .cat-header {
        display: flex; align-items: center; gap: .75rem;
        padding: .65rem 1rem;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.09);
        border-radius: 12px;
        margin-bottom: .75rem;
    }
    .cat-header .cat-emoji { font-size: 1.3rem; }
    .cat-header .cat-name  { font-weight: 700; font-size: 1rem; }
    .cat-header .cat-count { font-size: .78rem; color: rgba(200,197,255,.45); margin-left: auto; }

    /* TASK ROW */
    .task-row {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 10px;
        padding: .75rem 1rem;
        display: flex; align-items: center; gap: 1rem;
        transition: border-color .2s;
    }
    .task-row:hover { border-color: rgba(112,72,233,0.35); }
    .task-title { font-size: .9rem; font-weight: 500; }
    .task-title.done { text-decoration: line-through; opacity: .45; }
    .task-date { font-size: .72rem; color: rgba(200,197,255,.4); }

    /* STATUT BADGES */
    .badge-done  { background: rgba(26,243,217,0.12);  color: var(--cyan); border: 1px solid rgba(26,243,217,0.25);  font-size: .7rem; }
    .badge-going { background: rgba(126,181,216,0.12); color: var(--sky);  border: 1px solid rgba(126,181,216,0.25); font-size: .7rem; }
    .badge-todo  { background: rgba(255,255,255,0.06); color: rgba(200,197,255,0.55); border: 1px solid rgba(255,255,255,0.1); font-size: .7rem; }

    /* ACTION BUTTONS */
    .btn-action {
        border-radius: 8px; font-size: .75rem; padding: .35rem .7rem;
        display: inline-flex; align-items: center; gap: .3rem;
        white-space: nowrap; cursor: pointer;
    }
    .btn-edit   { background: rgba(64,109,207,0.15); color: var(--sky);  border: 1px solid rgba(64,109,207,0.25); }
    .btn-edit:hover   { background: rgba(64,109,207,0.3); color: #fff; }
    .btn-show   { background: rgba(112,72,233,0.15); color: #B09AFF; border: 1px solid rgba(112,72,233,0.25); }
    .btn-show:hover   { background: rgba(112,72,233,0.3); color: #fff; }
    .btn-delete { background: rgba(255,80,80,0.1);  color: #FF8080; border: 1px solid rgba(255,80,80,0.2); }
    .btn-delete:hover { background: rgba(255,80,80,0.25); color: #fff; }

    /* EMPTY STATE */
    .empty-state {
        text-align: center; padding: 1.5rem;
        color: rgba(200,197,255,.3); font-size: .85rem;
        border: 1px dashed rgba(255,255,255,.08); border-radius: 10px;
    }

    /* MODALE */
    .modal-content {
        background: #16132E;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 16px;
        color: #E8E6FF;
    }
    .modal-header { border-bottom: 1px solid rgba(255,255,255,0.08); padding: 1.2rem 1.5rem; }
    .modal-footer { border-top: 1px solid rgba(255,255,255,0.08); padding: 1rem 1.5rem; }
    .modal-title  { font-weight: 700; font-size: 1.1rem; }
    .btn-close    { filter: invert(1) opacity(.5); }
    .btn-close:hover { filter: invert(1) opacity(1); }

    .detail-row {
        display: flex; gap: .75rem; align-items: flex-start;
        padding: .75rem 0;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .detail-row:last-child { border-bottom: none; }
    .detail-label { font-size: .78rem; color: rgba(200,197,255,.45); min-width: 110px; padding-top: .1rem; }
    .detail-value { font-size: .9rem; color: #E8E6FF; }

    footer { background: #16132E; border-top: 1px solid rgba(255,255,255,0.07); font-size: .82rem; color: rgba(200,197,255,.35); }
    footer span { color: var(--cyan); }
</style>
<body>

<!-- CONTENU -->


<div class="container py-5" style="max-width: 820px;">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h1 class="fw-bold mb-1" style="font-size:1.8rem;">Mes Catégories</h1>
            <p style="color:rgba(200,197,255,.5);font-size:.9rem;margin:0;"><?= count($categories) ?> Catégorie au total</p>
        </div>
        <a href="/categorie/create" class="btn btn-violet px-4">
            <i class="bi bi-plus-circle me-2"></i>Nouvelle Catégorie
        </a>
    </div>

    <?php foreach ($categories as $cat): ?>
    <div class="mb-4">
        <div class="cat-header">
            <span class="cat-name"><?= $cat->nom ?></span>
            <span class="cat-count"></span>
        </div>

        <div class="d-flex gap-2">
            <a class="btn-action btn-edit"><i class="bi bi-pencil"></i> Modifier</a>
            <a class="btn-action btn-show"><i class="bi bi-eye"></i> Afficher</a>
            <a class="tn-action btn-delete"><i class="bi bi-trash"></i> Supprimer</a>
        </div>
    </div>
<?php endforeach; ?>
</div>


