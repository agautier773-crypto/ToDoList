<?php

use App\Helpers\Csrf;

?>
<!-- ── Dépendances (à inclure une seule fois dans la page hôte) ── -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>

<style>
    .nx-root {
        --nx-violet : #7048E9;
        --nx-cyan   : #1AF3D9;
        --nx-blue   : #7EB5D8;
        --nx-mid    : #406DCF;
        --nx-dark   : #0e0e1a;
        --nx-panel  : #13131f;
        --nx-border : rgba(255,255,255,.10);
        --nx-muted  : rgba(255,255,255,.45);
        --nx-card   : rgba(255,255,255,.04);

        font-family: 'DM Sans', sans-serif;
        background: var(--nx-dark);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    /* Orbes */
    .nx-orb { position:absolute; border-radius:50%; filter:blur(90px); pointer-events:none; animation:nx-drift 14s ease-in-out infinite alternate; }
    .nx-orb-1 { width:480px; height:480px; background:var(--nx-violet); opacity:.28; top:-140px; left:-120px; }
    .nx-orb-2 { width:360px; height:360px; background:var(--nx-mid);    opacity:.25; bottom:-100px; right:-80px; animation-duration:10s; animation-delay:-3s; }
    .nx-orb-3 { width:240px; height:240px; background:var(--nx-cyan);   opacity:.10; top:40%; left:60%; animation-duration:18s; }
    @keyframes nx-drift {
        from { transform:translate(0,0) scale(1); }
        to   { transform:translate(26px,16px) scale(1.07); }
    }

    /* Grille */
    .nx-grid {
        position:absolute; inset:0; pointer-events:none; z-index:0;
        background-image:
                linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
        background-size:48px 48px;
    }

    /* Card */
    .nx-card {
        position:relative; z-index:1;
        width:100%; max-width:480px;
        border-radius:24px; overflow:hidden;
        box-shadow:0 32px 80px rgba(0,0,0,.55), 0 0 0 1px var(--nx-border);
        background:var(--nx-panel);
        padding:52px 44px;
    }

    /* Titre */
    .nx-title    { font-family:'Syne',sans-serif; font-weight:800; font-size:1.75rem; color:#fff; letter-spacing:-.03em; }
    .nx-subtitle { font-size:.84rem; color:var(--nx-muted); }
    .nx-subtitle a { color:var(--nx-blue); text-decoration:none; transition:color .2s; }
    .nx-subtitle a:hover { color:var(--nx-cyan); }

    /* Labels & inputs */
    .nx-label { display:block; font-size:.76rem; font-weight:500; color:rgba(255,255,255,.52); margin-bottom:6px; letter-spacing:.03em; text-transform:uppercase; }
    .nx-wrap  { position:relative; }
    .nx-ico   { position:absolute; left:13px; top:50%; transform:translateY(-50%); color:rgba(255,255,255,.20); font-size:.9rem; pointer-events:none; transition:color .25s; }
    .nx-input {
        width:100%; padding:11px 14px 11px 36px;
        border-radius:12px; border:1px solid var(--nx-border);
        background:var(--nx-card); color:#fff;
        font-family:'DM Sans',sans-serif; font-size:.875rem;
        outline:none; transition:border-color .25s, background .25s, box-shadow .25s;
    }
    .nx-input::placeholder { color:rgba(255,255,255,.18); }
    .nx-input:focus {
        border-color:var(--nx-violet);
        background:rgba(112,72,233,.08);
        box-shadow:0 0 0 3px rgba(112,72,233,.18);
    }
    .nx-wrap:focus-within .nx-ico { color:var(--nx-blue); }

    /* Toggle password */
    .nx-eye { position:absolute; right:13px; top:50%; transform:translateY(-50%); background:none; border:none; outline:none; color:rgba(255,255,255,.22); cursor:pointer; transition:color .2s; font-size:.95rem; padding:0; }
    .nx-eye:hover { color:rgba(255,255,255,.6); }
    .nx-pr { padding-right:38px !important; }

    /* Jauge force */
    .nx-bar { display:flex; gap:4px; margin-top:7px; }
    .nx-seg { height:3px; flex:1; border-radius:99px; background:rgba(255,255,255,.08); transition:background .3s; }

    /* Checkbox */
    .nx-check {
        width:17px; height:17px; border-radius:5px; flex-shrink:0; margin-top:2px;
        border:1px solid var(--nx-border); background:var(--nx-card);
        appearance:none; cursor:pointer; position:relative;
        transition:background .2s, border-color .2s;
    }
    .nx-check:checked { background:var(--nx-violet); border-color:var(--nx-violet); }
    .nx-check:checked::after {
        content:''; position:absolute; inset:3px;
        background:url("data:image/svg+xml,%3Csvg viewBox='0 0 10 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 4L3.5 6.5L9 1' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") no-repeat center/contain;
    }
    .nx-check-lbl { font-size:.78rem; color:rgba(255,255,255,.45); line-height:1.55; }
    .nx-check-lbl a { color:var(--nx-blue); text-decoration:none; }
    .nx-check-lbl a:hover { color:var(--nx-cyan); }

    /* Bouton submit */
    .nx-btn {
        width:100%; padding:13px; border-radius:14px; border:none;
        background:linear-gradient(135deg, var(--nx-violet) 0%, var(--nx-mid) 100%);
        color:#fff; font-family:'Syne',sans-serif; font-weight:700; font-size:.93rem;
        cursor:pointer; letter-spacing:.01em; position:relative; overflow:hidden;
        box-shadow:0 4px 24px rgba(112,72,233,.35);
        transition:transform .2s, box-shadow .2s;
    }
    .nx-btn::before { content:''; position:absolute; inset:0; background:linear-gradient(135deg,rgba(26,243,217,.18) 0%,transparent 60%); opacity:0; transition:opacity .3s; }
    .nx-btn:hover { transform:translateY(-2px); box-shadow:0 8px 32px rgba(112,72,233,.45); }
    .nx-btn:hover::before { opacity:1; }
    .nx-btn:active { transform:translateY(0); }

    /* Séparateur décoratif */
    .nx-sep { height:1px; background:var(--nx-border); margin: 28px 0; }

    /* Animations */
    .nx-fade > * { opacity:0; transform:translateY(12px); animation:nx-up .45s ease forwards; }
    .nx-fade > *:nth-child(1){animation-delay:.04s}
    .nx-fade > *:nth-child(2){animation-delay:.09s}
    .nx-fade > *:nth-child(3){animation-delay:.14s}
    .nx-fade > *:nth-child(4){animation-delay:.19s}
    .nx-fade > *:nth-child(5){animation-delay:.24s}
    .nx-fade > *:nth-child(6){animation-delay:.29s}
    .nx-fade > *:nth-child(7){animation-delay:.34s}
    .nx-fade > *:nth-child(8){animation-delay:.39s}
    @keyframes nx-up { to { opacity:1; transform:translateY(0); } }

    @media(max-width:520px){
        .nx-card { padding:36px 22px; border-radius:18px; }
    }
</style>

<!-- ════════════════════ CONTENEUR ════════════════════ -->
<div class="nx-root">

    <div class="nx-orb nx-orb-1"></div>
    <div class="nx-orb nx-orb-2"></div>
    <div class="nx-orb nx-orb-3"></div>
    <div class="nx-grid"></div>

    <div class="nx-card">
        <div class="nx-fade">

            <!-- En-tête -->
            <div class="nx-title mb-1">Créer un compte</div>
            <p class="nx-subtitle mb-4">
                Déjà membre ? <a href="/login">Se connecter</a>
            </p>

            <div class="nx-sep"></div>

            <!-- ── Formulaire ── -->
            <form action="/users/create" method="POST">
                <?= Csrf::field(); ?>

                <!-- Prénom + Nom -->
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label for="prenom" class="nx-label">Prénom</label>
                        <div class="nx-wrap">
                            <input
                                    type="text"
                                    id="prenom"
                                    name="prenom"
                                    class="nx-input"
                                    placeholder="Jean"
                                    autocomplete="given-name"
                                    required
                            />
                            <i class="bi bi-person nx-ico"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="nom" class="nx-label">Nom</label>
                        <div class="nx-wrap">
                            <input
                                    type="text"
                                    id="nom"
                                    name="nom"
                                    class="nx-input"
                                    placeholder="Dupont"
                                    autocomplete="family-name"
                                    required
                            />
                            <i class="bi bi-person nx-ico"></i>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="nx-label">Adresse e-mail</label>
                    <div class="nx-wrap">
                        <input
                                type="email"
                                id="email"
                                name="email"
                                class="nx-input"
                                placeholder="jean.dupont@exemple.fr"
                                autocomplete="email"
                                required
                        />
                        <i class="bi bi-envelope nx-ico"></i>
                    </div>
                </div>

                <!-- Mot de passe -->
                <div class="mb-3">
                    <label for="password" class="nx-label">Mot de passe</label>
                    <div class="nx-wrap">
                        <input
                                type="password"
                                id="password"
                                name="password"
                                class="nx-input nx-pr"
                                placeholder="8 caractères minimum"
                                autocomplete="new-password"
                                oninput="nxStrength(this.value)"
                                required
                        />
                        <i class="bi bi-lock nx-ico"></i>
                        <button class="nx-eye" type="button" onclick="nxTogglePw('password','nx-eye-pw')">
                            <i class="bi bi-eye" id="nx-eye-pw"></i>
                        </button>
                    </div>
                    <div class="nx-bar">
                        <div class="nx-seg" id="nx-s1"></div>
                        <div class="nx-seg" id="nx-s2"></div>
                        <div class="nx-seg" id="nx-s3"></div>
                        <div class="nx-seg" id="nx-s4"></div>
                    </div>
                </div>

                <!-- Confirmation mot de passe -->
                <div class="mb-4">
                    <label for="password_confirmation" class="nx-label">Confirmer le mot de passe</label>
                    <div class="nx-wrap">
                        <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="nx-input nx-pr"
                                placeholder="Répétez votre mot de passe"
                                autocomplete="new-password"
                                required
                        />
                        <i class="bi bi-lock-fill nx-ico"></i>
                        <button class="nx-eye" type="button" onclick="nxTogglePw('password_confirmation','nx-eye-pw2')">
                            <i class="bi bi-eye" id="nx-eye-pw2"></i>
                        </button>
                    </div>
                </div>

                <!-- CGU -->
                <div class="d-flex align-items-start gap-2 mb-4">
                    <input
                            type="checkbox"
                            id="accept_terms"
                            name="accept_terms"
                            value="1"
                            class="nx-check"
                            required
                    />
                    <label class="nx-check-lbl" for="accept_terms">
                        J'accepte les <a href="/users/terms">conditions d'utilisation</a>
                        et la <a href="/users/privacy">politique de confidentialité</a>.
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit" class="nx-btn">
                    Créer mon compte &nbsp;→
                </button>

            </form>
            <!-- /form -->

        </div>
    </div>

</div>

<script>
    /* Toggle affichage mot de passe */
    function nxTogglePw(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type     = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type     = 'password';
            icon.className = 'bi bi-eye';
        }
    }

    /* Jauge de force du mot de passe */
    const nxColors = ['#FF4D6D', '#FF9A3C', '#7EB5D8', '#1AF3D9'];
    function nxStrength(val) {
        let score = 0;
        if (val.length >= 8)            score++;
        if (/[A-Z]/.test(val))          score++;
        if (/[0-9]/.test(val))          score++;
        if (/[^A-Za-z0-9]/.test(val))   score++;
        for (let i = 1; i <= 4; i++) {
            document.getElementById('nx-s' + i).style.background =
                i <= score ? nxColors[score - 1] : 'rgba(255,255,255,.08)';
        }
    }
</script>