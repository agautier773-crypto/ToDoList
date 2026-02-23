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
        position: relative;
        overflow-x: hidden;
        color: rgba(255,255,255,.80);
    }

    /* Orbes */
    .nx-orb { position:fixed; border-radius:50%; filter:blur(100px); pointer-events:none; animation:nx-drift 14s ease-in-out infinite alternate; }
    .nx-orb-1 { width:500px; height:500px; background:var(--nx-violet); opacity:.20; top:-160px; left:-140px; }
    .nx-orb-2 { width:380px; height:380px; background:var(--nx-mid);    opacity:.18; bottom:-100px; right:-80px; animation-duration:11s; animation-delay:-4s; }
    .nx-orb-3 { width:260px; height:260px; background:var(--nx-cyan);   opacity:.08; top:40%; left:65%; animation-duration:19s; }
    @keyframes nx-drift {
        from { transform:translate(0,0) scale(1); }
        to   { transform:translate(26px,16px) scale(1.07); }
    }

    /* Grille */
    .nx-grid {
        position:fixed; inset:0; pointer-events:none; z-index:0;
        background-image:
                linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
        background-size:48px 48px;
    }

    /* ── Barre de navigation ── */
    .nx-navbar {
        position: sticky; top: 0; z-index: 100;
        padding: 18px 0;
        background: rgba(14,14,26,.75);
        backdrop-filter: blur(18px);
        border-bottom: 1px solid var(--nx-border);
    }
    .nx-brand { display:flex; align-items:center; gap:10px; color:#fff; font-family:'Syne',sans-serif; font-weight:800; font-size:1.15rem; letter-spacing:-.02em; text-decoration:none; }
    .nx-brand:hover { color:#fff; }
    .nx-brand-dot { width:26px; height:26px; border-radius:7px; background:rgba(255,255,255,.15); display:flex; align-items:center; justify-content:center; }
    .nx-brand-dot::after { content:''; width:11px; height:11px; border-radius:3px; background:var(--nx-cyan); display:block; }
    .nx-back {
        display:inline-flex; align-items:center; gap:7px;
        font-size:.82rem; color:var(--nx-muted); text-decoration:none;
        transition:color .2s;
    }
    .nx-back:hover { color:var(--nx-blue); }

    /* ── Contenu principal ── */
    .nx-wrap-page {
        position: relative; z-index: 1;
        max-width: 860px; margin: 0 auto;
        padding: 56px 24px 100px;
    }

    /* Hero */
    .nx-hero-badge {
        display:inline-flex; align-items:center; gap:7px;
        padding:5px 14px; border-radius:99px;
        border:1px solid rgba(112,72,233,.35);
        background:rgba(112,72,233,.10);
        font-size:.75rem; font-weight:500; color:var(--nx-blue);
        letter-spacing:.04em; text-transform:uppercase;
        margin-bottom:20px;
    }
    .nx-page-title {
        font-family:'Syne',sans-serif; font-weight:800;
        font-size:clamp(2rem,5vw,3.2rem);
        line-height:1.08; color:#fff; letter-spacing:-.03em;
    }
    .nx-page-title span { color:var(--nx-cyan); }
    .nx-page-meta {
        font-size:.83rem; color:var(--nx-muted);
        margin-top:14px;
    }

    /* Barre de progression de lecture */
    .nx-progress-bar {
        position:fixed; top:0; left:0; z-index:200;
        height:3px; width:0%;
        background:linear-gradient(90deg, var(--nx-violet), var(--nx-cyan));
        transition:width .1s linear;
    }

    /* Sommaire */
    .nx-toc {
        position:sticky; top:80px;
        background:var(--nx-panel);
        border:1px solid var(--nx-border);
        border-radius:16px; padding:24px 22px;
    }
    .nx-toc-title {
        font-family:'Syne',sans-serif; font-weight:700;
        font-size:.82rem; color:rgba(255,255,255,.40);
        text-transform:uppercase; letter-spacing:.08em;
        margin-bottom:14px;
    }
    .nx-toc a {
        display:flex; align-items:center; gap:8px;
        font-size:.82rem; color:rgba(255,255,255,.50);
        text-decoration:none; padding:6px 8px;
        border-radius:8px; transition:background .2s, color .2s;
    }
    .nx-toc a:hover { background:rgba(255,255,255,.05); color:var(--nx-blue); }
    .nx-toc a.active { color:var(--nx-cyan); background:rgba(26,243,217,.07); }
    .nx-toc a .nx-toc-num {
        font-size:.7rem; color:rgba(255,255,255,.22);
        font-weight:600; min-width:18px;
    }

    /* Séparateur hero */
    .nx-hero-sep {
        height:1px; background:linear-gradient(90deg, var(--nx-violet), transparent);
        margin:40px 0; opacity:.4;
    }

    /* Sections */
    .nx-section { margin-bottom:52px; scroll-margin-top:96px; }

    .nx-section-header {
        display:flex; align-items:center; gap:14px;
        margin-bottom:20px;
    }
    .nx-section-num {
        width:36px; height:36px; border-radius:10px; flex-shrink:0;
        background:linear-gradient(135deg, var(--nx-violet), var(--nx-mid));
        display:flex; align-items:center; justify-content:center;
        font-family:'Syne',sans-serif; font-weight:800; font-size:.82rem; color:#fff;
    }
    .nx-section-title {
        font-family:'Syne',sans-serif; font-weight:700;
        font-size:1.15rem; color:#fff; letter-spacing:-.015em;
        margin:0;
    }

    .nx-section p {
        font-size:.92rem; line-height:1.80;
        color:rgba(255,255,255,.68);
        margin-bottom:14px;
    }
    .nx-section p:last-child { margin-bottom:0; }

    /* Liste stylisée */
    .nx-list { list-style:none; padding:0; margin:0 0 14px; display:flex; flex-direction:column; gap:8px; }
    .nx-list li {
        display:flex; align-items:flex-start; gap:10px;
        font-size:.88rem; line-height:1.65; color:rgba(255,255,255,.65);
    }
    .nx-list li::before {
        content:''; flex-shrink:0;
        width:6px; height:6px; border-radius:50%;
        background:var(--nx-violet);
        margin-top:8px;
    }

    /* Bloc highlight */
    .nx-highlight {
        border-left:3px solid var(--nx-violet);
        background:rgba(112,72,233,.07);
        border-radius:0 12px 12px 0;
        padding:16px 20px;
        font-size:.88rem; line-height:1.70;
        color:rgba(255,255,255,.65);
        margin:16px 0;
    }
    .nx-highlight strong { color:var(--nx-blue); font-weight:500; }

    /* Bloc contact */
    .nx-contact-card {
        background:var(--nx-card);
        border:1px solid var(--nx-border);
        border-radius:16px; padding:24px 26px;
        display:flex; align-items:center; gap:18px;
        text-decoration:none;
        transition:border-color .25s, background .25s;
    }
    .nx-contact-card:hover {
        border-color:rgba(112,72,233,.45);
        background:rgba(112,72,233,.07);
    }
    .nx-contact-icon {
        width:44px; height:44px; border-radius:12px; flex-shrink:0;
        background:linear-gradient(135deg, var(--nx-violet), var(--nx-mid));
        display:flex; align-items:center; justify-content:center;
        font-size:1.1rem; color:#fff;
    }
    .nx-contact-label { font-size:.78rem; color:var(--nx-muted); }
    .nx-contact-value { font-size:.93rem; color:#fff; font-weight:500; }

    /* Bouton retour */
    .nx-btn-back {
        display:inline-flex; align-items:center; gap:8px;
        padding:11px 22px; border-radius:12px; border:none;
        background:linear-gradient(135deg, var(--nx-violet) 0%, var(--nx-mid) 100%);
        color:#fff; font-family:'Syne',sans-serif; font-weight:700; font-size:.88rem;
        cursor:pointer; text-decoration:none;
        box-shadow:0 4px 20px rgba(112,72,233,.30);
        transition:transform .2s, box-shadow .2s;
    }
    .nx-btn-back:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(112,72,233,.45); color:#fff; }

    /* Footer de page */
    .nx-page-footer {
        border-top:1px solid var(--nx-border);
        padding-top:32px; margin-top:60px;
        display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:14px;
        font-size:.78rem; color:rgba(255,255,255,.28);
    }

    /* Animations */
    .nx-fade-in { opacity:0; transform:translateY(16px); animation:nx-up .5s ease forwards; }
    .nx-fade-in:nth-child(1){animation-delay:.04s}
    .nx-fade-in:nth-child(2){animation-delay:.10s}
    .nx-fade-in:nth-child(3){animation-delay:.16s}
    @keyframes nx-up { to { opacity:1; transform:translateY(0); } }

    @media(max-width:768px){
        .nx-toc-col { display:none; }
    }
</style>

<!-- Barre de progression -->
<div class="nx-progress-bar" id="nx-progress"></div>

<!-- ════════════════════ CONTENEUR ════════════════════ -->
<div class="nx-root">
    <div class="nx-orb nx-orb-1"></div>
    <div class="nx-orb nx-orb-2"></div>
    <div class="nx-orb nx-orb-3"></div>
    <div class="nx-grid"></div>

    <!-- Navbar -->
    <nav class="nx-navbar">
        <div class="container-lg d-flex align-items-center justify-content-between">
            <a href="/" class="nx-brand">
                <div class="nx-brand-dot"></div>
                ToDoList
            </a>
            <a href="/users/create" class="nx-back">
                <i class="bi bi-arrow-left"></i> Retour à l'inscription
            </a>
        </div>
    </nav>

    <!-- Corps de page -->
    <div class="nx-wrap-page">
        <div class="row g-5">

            <!-- ── Colonne contenu ── -->
            <div class="col-lg-8">

                <!-- Hero -->
                <div class="nx-fade-in">
                    <div class="nx-hero-badge">
                        <i class="bi bi-file-text"></i>
                        Document légal
                    </div>
                    <h1 class="nx-page-title">
                        Conditions<br><span>d'utilisation</span>
                    </h1>
                    <p class="nx-page-meta">
                        <i class="bi bi-calendar3 me-1"></i> Dernière mise à jour : 1er janvier 2026
                        &nbsp;·&nbsp;
                        <i class="bi bi-clock me-1"></i> Lecture : ~5 min
                    </p>
                </div>

                <div class="nx-hero-sep"></div>

                <!-- Introduction -->
                <div class="nx-fade-in">
                    <div class="nx-highlight">
                        <strong>Bienvenue chez ToDoList.</strong> En accédant à nos services, vous acceptez
                        les présentes conditions dans leur intégralité. Veuillez les lire attentivement
                        avant de créer votre compte ou d'utiliser notre plateforme.
                    </div>
                </div>

                <!-- ── Section 1 ── -->
                <div class="nx-section" id="s1">
                    <div class="nx-section-header">
                        <div class="nx-section-num">01</div>
                        <h2 class="nx-section-title">Acceptation des conditions</h2>
                    </div>
                    <p>En créant un compte ou en utilisant les services ToDoList, vous reconnaissez avoir lu, compris et accepté d'être lié par les présentes Conditions d'utilisation, ainsi que par notre Politique de confidentialité.</p>
                    <p>Si vous utilisez ToDoList au nom d'une organisation, vous déclarez être autorisé à engager cette organisation et à accepter ces conditions en son nom.</p>
                    <ul class="nx-list">
                        <li>Vous devez avoir au moins 16 ans pour créer un compte.</li>
                        <li>Votre utilisation des services est soumise au droit français en vigueur.</li>
                        <li>ToDoList se réserve le droit de modifier ces conditions à tout moment avec préavis.</li>
                    </ul>
                </div>

                <!-- ── Section 2 ── -->
                <div class="nx-section" id="s2">
                    <div class="nx-section-header">
                        <div class="nx-section-num">02</div>
                        <h2 class="nx-section-title">Création et sécurité du compte</h2>
                    </div>
                    <p>Pour accéder à certaines fonctionnalités, vous devez créer un compte en fournissant des informations exactes et à jour. Vous êtes seul responsable de la confidentialité de vos identifiants.</p>
                    <ul class="nx-list">
                        <li>Choisissez un mot de passe fort et unique, non réutilisé ailleurs.</li>
                        <li>Ne partagez jamais vos identifiants avec des tiers.</li>
                        <li>Signalez immédiatement tout accès non autorisé à <strong>security@todolist.fr</strong>.</li>
                        <li>ToDoList ne sera pas responsable des pertes résultant d'un accès non autorisé dû à votre négligence.</li>
                    </ul>
                    <div class="nx-highlight">
                        <strong>Astuce :</strong> Activez l'authentification à deux facteurs (2FA) depuis votre espace personnel pour renforcer la sécurité de votre compte.
                    </div>
                </div>

                <!-- ── Section 3 ── -->
                <div class="nx-section" id="s3">
                    <div class="nx-section-header">
                        <div class="nx-section-num">03</div>
                        <h2 class="nx-section-title">Utilisation acceptable</h2>
                    </div>
                    <p>Vous vous engagez à utiliser les services ToDoList de manière légale, éthique et conforme aux présentes conditions. Sont notamment interdits :</p>
                    <ul class="nx-list">
                        <li>La diffusion de contenus illicites, diffamatoires, obscènes ou portant atteinte aux droits de tiers.</li>
                        <li>Toute tentative d'accès non autorisé à nos systèmes ou aux comptes d'autres utilisateurs.</li>
                        <li>L'utilisation de robots, scrapers ou tout autre moyen automatisé sans autorisation écrite.</li>
                        <li>La revente ou la redistribution des services sans accord préalable de ToDoList.</li>
                        <li>Toute action susceptible de perturber, surcharger ou compromettre l'intégrité de nos infrastructures.</li>
                    </ul>
                    <p>Toute violation peut entraîner la suspension immédiate de votre compte, sans préjudice des recours légaux disponibles.</p>
                </div>

                <!-- ── Section 4 ── -->
                <div class="nx-section" id="s4">
                    <div class="nx-section-header">
                        <div class="nx-section-num">04</div>
                        <h2 class="nx-section-title">Propriété intellectuelle</h2>
                    </div>
                    <p>L'ensemble des éléments constituant la plateforme ToDoList — logiciels, interfaces, marques, logos, textes, graphiques et bases de données — sont la propriété exclusive de ToDoList SAS ou de ses partenaires et sont protégés par le droit de la propriété intellectuelle.</p>
                    <p>Toute reproduction, représentation, modification ou exploitation non expressément autorisée est strictement interdite.</p>
                    <ul class="nx-list">
                        <li>Les contenus que vous publiez restent votre propriété. Vous accordez à ToDoList une licence limitée pour les héberger et les afficher dans le cadre du service.</li>
                        <li>Vous garantissez disposer de tous les droits nécessaires sur les contenus que vous partagez.</li>
                    </ul>
                </div>

                <!-- ── Section 5 ── -->
                <div class="nx-section" id="s5">
                    <div class="nx-section-header">
                        <div class="nx-section-num">05</div>
                        <h2 class="nx-section-title">Données personnelles &amp; vie privée</h2>
                    </div>
                    <p>La collecte et le traitement de vos données personnelles sont régis par notre <a href="/privacy" style="color:var(--nx-blue);text-decoration:none;">Politique de confidentialité</a>, conforme au Règlement Général sur la Protection des Données (RGPD).</p>
                    <ul class="nx-list">
                        <li>Nous collectons uniquement les données nécessaires au bon fonctionnement du service.</li>
                        <li>Vos données ne sont jamais revendues à des tiers à des fins commerciales.</li>
                        <li>Vous disposez d'un droit d'accès, de rectification, de portabilité et d'effacement de vos données.</li>
                        <li>Pour exercer ces droits, contactez <strong>privacy@todolist.fr</strong>.</li>
                    </ul>
                </div>

                <!-- ── Section 6 ── -->
                <div class="nx-section" id="s6">
                    <div class="nx-section-header">
                        <div class="nx-section-num">06</div>
                        <h2 class="nx-section-title">Limitation de responsabilité</h2>
                    </div>
                    <p>ToDoList s'efforce de maintenir ses services disponibles en continu, mais ne peut garantir une disponibilité ininterrompue ou sans erreur. Dans les limites permises par la loi :</p>
                    <ul class="nx-list">
                        <li>ToDoList ne pourra être tenu responsable des pertes indirectes, consécutives ou immatérielles.</li>
                        <li>La responsabilité totale de ToDoList est limitée aux montants effectivement payés par l'utilisateur au cours des 12 derniers mois.</li>
                        <li>ToDoList décline toute responsabilité pour les contenus publiés par les utilisateurs.</li>
                    </ul>
                    <div class="nx-highlight">
                        <strong>Important :</strong> Certaines juridictions n'autorisent pas la limitation de certaines garanties. Dans ce cas, les limitations ci-dessus s'appliquent dans la mesure permise par la loi applicable.
                    </div>
                </div>

                <!-- ── Section 7 ── -->
                <div class="nx-section" id="s7">
                    <div class="nx-section-header">
                        <div class="nx-section-num">07</div>
                        <h2 class="nx-section-title">Résiliation</h2>
                    </div>
                    <p>Vous pouvez résilier votre compte à tout moment depuis les paramètres de votre espace personnel ou en contactant notre support.</p>
                    <p>ToDoList se réserve le droit de suspendre ou de résilier votre accès en cas de violation des présentes conditions, sans préavis ni remboursement.</p>
                    <ul class="nx-list">
                        <li>Après résiliation, vos données seront conservées 30 jours puis supprimées définitivement, sauf obligation légale contraire.</li>
                        <li>Les sections relatives à la propriété intellectuelle et à la limitation de responsabilité survivent à la résiliation.</li>
                    </ul>
                </div>

                <!-- ── Section 8 ── -->
                <div class="nx-section" id="s8">
                    <div class="nx-section-header">
                        <div class="nx-section-num">08</div>
                        <h2 class="nx-section-title">Droit applicable &amp; litiges</h2>
                    </div>
                    <p>Les présentes conditions sont régies par le droit français. En cas de litige, une solution amiable sera recherchée en priorité. À défaut d'accord, les tribunaux compétents de Paris seront seuls compétents.</p>
                    <p>Pour toute réclamation, vous pouvez également recourir à la plateforme européenne de règlement en ligne des litiges (<a href="https://ec.europa.eu/odr" style="color:var(--nx-blue);text-decoration:none;" target="_blank">ec.europa.eu/odr</a>).</p>
                </div>

                <!-- Contact -->
                <div class="nx-section" id="s9">
                    <div class="nx-section-header">
                        <div class="nx-section-num">09</div>
                        <h2 class="nx-section-title">Nous contacter</h2>
                    </div>
                    <p>Pour toute question relative aux présentes conditions, vous pouvez nous joindre via :</p>
                    <div class="row g-3 mt-1">
                        <div class="col-sm-6">
                            <a href="mailto:legal@todolist.fr" class="nx-contact-card">
                                <div class="nx-contact-icon"><i class="bi bi-envelope"></i></div>
                                <div>
                                    <div class="nx-contact-label">Email juridique</div>
                                    <div class="nx-contact-value">legal@todolist.fr</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="mailto:support@todolist.fr" class="nx-contact-card">
                                <div class="nx-contact-icon"><i class="bi bi-headset"></i></div>
                                <div>
                                    <div class="nx-contact-label">Support utilisateur</div>
                                    <div class="nx-contact-value">support@todolist.fr</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Footer de page -->
                <div class="nx-page-footer">
                    <span>© 2026 ToDoList SAS — Tous droits réservés.</span>
                    <a href="/users/create" class="nx-btn-back">
                        <i class="bi bi-arrow-left"></i> Retour à l'inscription
                    </a>
                </div>

            </div>
            <!-- /col contenu -->

            <!-- ── Sommaire latéral ── -->
            <div class="col-lg-4 nx-toc-col">
                <div class="nx-toc">
                    <div class="nx-toc-title">Sommaire</div>
                    <a href="#s1" class="nx-toc-link"><span class="nx-toc-num">01</span> Acceptation des conditions</a>
                    <a href="#s2" class="nx-toc-link"><span class="nx-toc-num">02</span> Création du compte</a>
                    <a href="#s3" class="nx-toc-link"><span class="nx-toc-num">03</span> Utilisation acceptable</a>
                    <a href="#s4" class="nx-toc-link"><span class="nx-toc-num">04</span> Propriété intellectuelle</a>
                    <a href="#s5" class="nx-toc-link"><span class="nx-toc-num">05</span> Données personnelles</a>
                    <a href="#s6" class="nx-toc-link"><span class="nx-toc-num">06</span> Limitation de responsabilité</a>
                    <a href="#s7" class="nx-toc-link"><span class="nx-toc-num">07</span> Résiliation</a>
                    <a href="#s8" class="nx-toc-link"><span class="nx-toc-num">08</span> Droit applicable</a>
                    <a href="#s9" class="nx-toc-link"><span class="nx-toc-num">09</span> Nous contacter</a>
                </div>
            </div>

        </div><!-- /row -->
    </div><!-- /nx-wrap-page -->

</div><!-- /nx-root -->

<script>
    /* ── Barre de progression de lecture ── */
    const bar = document.getElementById('nx-progress');
    window.addEventListener('scroll', () => {
        const doc  = document.documentElement;
        const scrolled = doc.scrollTop / (doc.scrollHeight - doc.clientHeight);
        bar.style.width = (scrolled * 100) + '%';
    });

    /* ── Sommaire : section active ── */
    const sections = document.querySelectorAll('.nx-section');
    const tocLinks = document.querySelectorAll('.nx-toc-link');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                tocLinks.forEach(l => l.classList.remove('active'));
                const active = document.querySelector(`.nx-toc-link[href="#${e.target.id}"]`);
                if (active) active.classList.add('active');
            }
        });
    }, { rootMargin: '-20% 0px -70% 0px' });

    sections.forEach(s => observer.observe(s));
</script>