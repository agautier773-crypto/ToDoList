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

    /* ── Navbar ── */
    .nx-navbar {
        position:sticky; top:0; z-index:100;
        padding:18px 0;
        background:rgba(14,14,26,.75);
        backdrop-filter:blur(18px);
        border-bottom:1px solid var(--nx-border);
    }
    .nx-brand { display:flex; align-items:center; gap:10px; color:#fff; font-family:'Syne',sans-serif; font-weight:800; font-size:1.15rem; letter-spacing:-.02em; text-decoration:none; }
    .nx-brand:hover { color:#fff; }
    .nx-brand-dot { width:26px; height:26px; border-radius:7px; background:rgba(255,255,255,.15); display:flex; align-items:center; justify-content:center; }
    .nx-brand-dot::after { content:''; width:11px; height:11px; border-radius:3px; background:var(--nx-cyan); display:block; }
    .nx-back { display:inline-flex; align-items:center; gap:7px; font-size:.82rem; color:var(--nx-muted); text-decoration:none; transition:color .2s; }
    .nx-back:hover { color:var(--nx-blue); }

    /* ── Contenu ── */
    .nx-wrap-page {
        position:relative; z-index:1;
        max-width:860px; margin:0 auto;
        padding:56px 24px 100px;
    }

    /* Hero badge */
    .nx-hero-badge {
        display:inline-flex; align-items:center; gap:7px;
        padding:5px 14px; border-radius:99px;
        border:1px solid rgba(64,109,207,.40);
        background:rgba(64,109,207,.12);
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
    .nx-page-meta { font-size:.83rem; color:var(--nx-muted); margin-top:14px; }

    /* Barre de progression */
    .nx-progress-bar {
        position:fixed; top:0; left:0; z-index:200;
        height:3px; width:0%;
        background:linear-gradient(90deg, var(--nx-mid), var(--nx-cyan));
        transition:width .1s linear;
    }

    /* Séparateur */
    .nx-hero-sep { height:1px; background:linear-gradient(90deg, var(--nx-mid), transparent); margin:40px 0; opacity:.4; }

    /* Sommaire */
    .nx-toc {
        position:sticky; top:80px;
        background:var(--nx-panel);
        border:1px solid var(--nx-border);
        border-radius:16px; padding:24px 22px;
    }
    .nx-toc-title { font-family:'Syne',sans-serif; font-weight:700; font-size:.82rem; color:rgba(255,255,255,.40); text-transform:uppercase; letter-spacing:.08em; margin-bottom:14px; }
    .nx-toc a { display:flex; align-items:center; gap:8px; font-size:.82rem; color:rgba(255,255,255,.50); text-decoration:none; padding:6px 8px; border-radius:8px; transition:background .2s, color .2s; }
    .nx-toc a:hover { background:rgba(255,255,255,.05); color:var(--nx-blue); }
    .nx-toc a.active { color:var(--nx-cyan); background:rgba(26,243,217,.07); }
    .nx-toc-num { font-size:.7rem; color:rgba(255,255,255,.22); font-weight:600; min-width:18px; }

    /* Sections */
    .nx-section { margin-bottom:52px; scroll-margin-top:96px; }
    .nx-section-header { display:flex; align-items:center; gap:14px; margin-bottom:20px; }
    .nx-section-num {
        width:36px; height:36px; border-radius:10px; flex-shrink:0;
        background:linear-gradient(135deg, var(--nx-mid), var(--nx-violet));
        display:flex; align-items:center; justify-content:center;
        font-family:'Syne',sans-serif; font-weight:800; font-size:.82rem; color:#fff;
    }
    .nx-section-title { font-family:'Syne',sans-serif; font-weight:700; font-size:1.15rem; color:#fff; letter-spacing:-.015em; margin:0; }
    .nx-section p { font-size:.92rem; line-height:1.80; color:rgba(255,255,255,.68); margin-bottom:14px; }
    .nx-section p:last-child { margin-bottom:0; }

    /* Liste */
    .nx-list { list-style:none; padding:0; margin:0 0 14px; display:flex; flex-direction:column; gap:8px; }
    .nx-list li { display:flex; align-items:flex-start; gap:10px; font-size:.88rem; line-height:1.65; color:rgba(255,255,255,.65); }
    .nx-list li::before { content:''; flex-shrink:0; width:6px; height:6px; border-radius:50%; background:var(--nx-mid); margin-top:8px; }

    /* Highlight */
    .nx-highlight {
        border-left:3px solid var(--nx-mid);
        background:rgba(64,109,207,.08);
        border-radius:0 12px 12px 0;
        padding:16px 20px;
        font-size:.88rem; line-height:1.70;
        color:rgba(255,255,255,.65);
        margin:16px 0;
    }
    .nx-highlight strong { color:var(--nx-blue); font-weight:500; }

    /* Tableau des données */
    .nx-table-wrap { overflow-x:auto; margin:16px 0; border-radius:14px; border:1px solid var(--nx-border); }
    .nx-table { width:100%; border-collapse:collapse; font-size:.84rem; }
    .nx-table thead tr { background:rgba(64,109,207,.12); }
    .nx-table th { padding:12px 16px; text-align:left; color:var(--nx-blue); font-weight:600; font-size:.78rem; text-transform:uppercase; letter-spacing:.04em; white-space:nowrap; }
    .nx-table td { padding:11px 16px; color:rgba(255,255,255,.62); border-top:1px solid var(--nx-border); vertical-align:top; line-height:1.55; }
    .nx-table tr:hover td { background:rgba(255,255,255,.02); }

    /* Droits pills */
    .nx-rights { display:flex; flex-wrap:wrap; gap:8px; margin-top:12px; }
    .nx-right-pill {
        display:inline-flex; align-items:center; gap:6px;
        padding:6px 14px; border-radius:99px;
        border:1px solid rgba(64,109,207,.35);
        background:rgba(64,109,207,.10);
        font-size:.78rem; color:var(--nx-blue);
    }

    /* Cartes contact */
    .nx-contact-card { background:var(--nx-card); border:1px solid var(--nx-border); border-radius:16px; padding:24px 26px; display:flex; align-items:center; gap:18px; text-decoration:none; transition:border-color .25s, background .25s; }
    .nx-contact-card:hover { border-color:rgba(64,109,207,.45); background:rgba(64,109,207,.07); }
    .nx-contact-icon { width:44px; height:44px; border-radius:12px; flex-shrink:0; background:linear-gradient(135deg, var(--nx-mid), var(--nx-violet)); display:flex; align-items:center; justify-content:center; font-size:1.1rem; color:#fff; }
    .nx-contact-label { font-size:.78rem; color:var(--nx-muted); }
    .nx-contact-value { font-size:.93rem; color:#fff; font-weight:500; }

    /* Bouton retour */
    .nx-btn-back { display:inline-flex; align-items:center; gap:8px; padding:11px 22px; border-radius:12px; border:none; background:linear-gradient(135deg, var(--nx-mid) 0%, var(--nx-violet) 100%); color:#fff; font-family:'Syne',sans-serif; font-weight:700; font-size:.88rem; cursor:pointer; text-decoration:none; box-shadow:0 4px 20px rgba(64,109,207,.30); transition:transform .2s, box-shadow .2s; }
    .nx-btn-back:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(64,109,207,.45); color:#fff; }

    /* Footer */
    .nx-page-footer { border-top:1px solid var(--nx-border); padding-top:32px; margin-top:60px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:14px; font-size:.78rem; color:rgba(255,255,255,.28); }

    /* Animations */
    .nx-fade-in { opacity:0; transform:translateY(16px); animation:nx-up .5s ease forwards; }
    .nx-fade-in:nth-child(1){animation-delay:.04s}
    .nx-fade-in:nth-child(2){animation-delay:.10s}
    .nx-fade-in:nth-child(3){animation-delay:.16s}
    @keyframes nx-up { to { opacity:1; transform:translateY(0); } }

    @media(max-width:768px){ .nx-toc-col { display:none; } }
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

    <!-- Corps -->
    <div class="nx-wrap-page">
        <div class="row g-5">

            <!-- ── Contenu ── -->
            <div class="col-lg-8">

                <!-- Hero -->
                <div class="nx-fade-in">
                    <div class="nx-hero-badge">
                        <i class="bi bi-shield-lock"></i>
                        RGPD · Confidentialité
                    </div>
                    <h1 class="nx-page-title">
                        Politique de<br><span>confidentialité</span>
                    </h1>
                    <p class="nx-page-meta">
                        <i class="bi bi-calendar3 me-1"></i> Dernière mise à jour : 1er janvier 2026
                        &nbsp;·&nbsp;
                        <i class="bi bi-clock me-1"></i> Lecture : ~6 min
                    </p>
                </div>

                <div class="nx-hero-sep"></div>

                <!-- Intro -->
                <div class="nx-fade-in">
                    <div class="nx-highlight">
                        <strong>Votre vie privée est notre priorité.</strong> ToDoList SAS s'engage à protéger vos données personnelles conformément au Règlement Général sur la Protection des Données (RGPD — UE 2016/679) et à la loi Informatique et Libertés. Cette politique explique quelles données nous collectons, pourquoi, et comment vous pouvez exercer vos droits.
                    </div>
                </div>

                <!-- ── Section 1 ── -->
                <div class="nx-section" id="s1">
                    <div class="nx-section-header">
                        <div class="nx-section-num">01</div>
                        <h2 class="nx-section-title">Responsable du traitement</h2>
                    </div>
                    <p>Le responsable du traitement de vos données personnelles est :</p>
                    <div class="nx-highlight">
                        <strong>ToDoList SAS</strong><br>
                        12 rue de la République, 75001 Paris, France<br>
                        SIRET : 123 456 789 00012<br>
                        Email : <strong>privacy@todolist.fr</strong><br>
                        Délégué à la Protection des Données (DPO) : <strong>dpo@todolist.fr</strong>
                    </div>
                </div>

                <!-- ── Section 2 ── -->
                <div class="nx-section" id="s2">
                    <div class="nx-section-header">
                        <div class="nx-section-num">02</div>
                        <h2 class="nx-section-title">Données collectées</h2>
                    </div>
                    <p>Nous collectons uniquement les données strictement nécessaires au bon fonctionnement du service. Voici un récapitulatif des données traitées :</p>
                    <div class="nx-table-wrap">
                        <table class="nx-table">
                            <thead>
                            <tr>
                                <th>Catégorie</th>
                                <th>Données</th>
                                <th>Source</th>
                                <th>Finalité</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Identité</td>
                                <td>Prénom, nom</td>
                                <td>Formulaire d'inscription</td>
                                <td>Personnalisation du compte</td>
                            </tr>
                            <tr>
                                <td>Contact</td>
                                <td>Adresse e-mail</td>
                                <td>Formulaire d'inscription</td>
                                <td>Authentification, notifications</td>
                            </tr>
                            <tr>
                                <td>Sécurité</td>
                                <td>Mot de passe (hashé)</td>
                                <td>Formulaire d'inscription</td>
                                <td>Authentification sécurisée</td>
                            </tr>
                            <tr>
                                <td>Navigation</td>
                                <td>Adresse IP, navigateur, pages visitées</td>
                                <td>Collecte automatique</td>
                                <td>Sécurité, statistiques anonymes</td>
                            </tr>
                            <tr>
                                <td>Utilisation</td>
                                <td>Tâches, listes, préférences</td>
                                <td>Usage du service</td>
                                <td>Fourniture du service</td>
                            </tr>
                            <tr>
                                <td>Paiement</td>
                                <td>Derniers 4 chiffres de carte, pays</td>
                                <td>Prestataire de paiement</td>
                                <td>Gestion des abonnements</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <p>Nous ne collectons jamais de données sensibles au sens de l'article 9 du RGPD (origine ethnique, convictions religieuses, données de santé, etc.).</p>
                </div>

                <!-- ── Section 3 ── -->
                <div class="nx-section" id="s3">
                    <div class="nx-section-header">
                        <div class="nx-section-num">03</div>
                        <h2 class="nx-section-title">Bases légales du traitement</h2>
                    </div>
                    <p>Chaque traitement de données repose sur l'une des bases légales suivantes prévues par le RGPD :</p>
                    <ul class="nx-list">
                        <li><strong style="color:var(--nx-blue)">Exécution du contrat</strong> — traitement nécessaire à la fourniture du service ToDoList (compte, tâches, synchronisation).</li>
                        <li><strong style="color:var(--nx-blue)">Intérêt légitime</strong> — sécurité de la plateforme, prévention de la fraude, amélioration du service.</li>
                        <li><strong style="color:var(--nx-blue)">Consentement</strong> — communications marketing, cookies non essentiels. Vous pouvez retirer votre consentement à tout moment.</li>
                        <li><strong style="color:var(--nx-blue)">Obligation légale</strong> — conservation des données de facturation conformément aux obligations comptables françaises (10 ans).</li>
                    </ul>
                </div>

                <!-- ── Section 4 ── -->
                <div class="nx-section" id="s4">
                    <div class="nx-section-header">
                        <div class="nx-section-num">04</div>
                        <h2 class="nx-section-title">Durées de conservation</h2>
                    </div>
                    <p>Vos données sont conservées uniquement le temps nécessaire aux finalités pour lesquelles elles ont été collectées :</p>
                    <ul class="nx-list">
                        <li>Données de compte actif : pendant toute la durée de votre abonnement ou usage du service.</li>
                        <li>Après fermeture du compte : suppression définitive sous <strong>30 jours</strong>, sauf obligation légale contraire.</li>
                        <li>Données de facturation : conservées <strong>10 ans</strong> en vertu des obligations comptables légales.</li>
                        <li>Logs de sécurité et de connexion : conservés <strong>12 mois</strong>.</li>
                        <li>Cookies de mesure d'audience : durée maximale de <strong>13 mois</strong> conformément aux recommandations CNIL.</li>
                    </ul>
                    <div class="nx-highlight">
                        <strong>Suppression anticipée :</strong> Vous pouvez demander la suppression de vos données à tout moment depuis votre espace personnel ou en écrivant à <strong>privacy@todolist.fr</strong>, sous réserve des obligations légales de conservation.
                    </div>
                </div>

                <!-- ── Section 5 ── -->
                <div class="nx-section" id="s5">
                    <div class="nx-section-header">
                        <div class="nx-section-num">05</div>
                        <h2 class="nx-section-title">Partage des données</h2>
                    </div>
                    <p>ToDoList ne vend jamais vos données personnelles. Elles peuvent être partagées uniquement dans les cas suivants :</p>
                    <ul class="nx-list">
                        <li><strong style="color:var(--nx-blue)">Sous-traitants techniques</strong> — hébergement (OVHcloud, France), envoi d'e-mails, paiement en ligne. Tous sont contractuellement tenus au respect du RGPD.</li>
                        <li><strong style="color:var(--nx-blue)">Obligations légales</strong> — réponse à une injonction judiciaire ou administrative valide.</li>
                        <li><strong style="color:var(--nx-blue)">Cession d'activité</strong> — en cas de fusion ou acquisition, vous serez notifié et pourrez exercer vos droits.</li>
                    </ul>
                    <p>Aucun de nos sous-traitants principaux ne transfère vos données en dehors de l'Union européenne. Si un transfert hors UE était nécessaire, il serait encadré par des Clauses Contractuelles Types (CCT) approuvées par la Commission européenne.</p>
                </div>

                <!-- ── Section 6 ── -->
                <div class="nx-section" id="s6">
                    <div class="nx-section-header">
                        <div class="nx-section-num">06</div>
                        <h2 class="nx-section-title">Cookies &amp; traceurs</h2>
                    </div>
                    <p>ToDoList utilise des cookies et technologies similaires pour le bon fonctionnement du service et l'amélioration de votre expérience :</p>
                    <ul class="nx-list">
                        <li><strong style="color:var(--nx-blue)">Cookies essentiels</strong> — session, authentification, sécurité CSRF. Ils ne peuvent pas être désactivés car ils sont indispensables au fonctionnement du service.</li>
                        <li><strong style="color:var(--nx-blue)">Cookies de préférences</strong> — mémorisation de votre langue, thème et paramètres d'affichage.</li>
                        <li><strong style="color:var(--nx-blue)">Cookies analytiques</strong> — mesure d'audience anonymisée (Matomo, hébergé en France). Déposés uniquement avec votre consentement.</li>
                    </ul>
                    <div class="nx-highlight">
                        Vous pouvez gérer vos préférences de cookies à tout moment via le <strong>Centre de confidentialité</strong> accessible depuis le pied de page de l'application.
                    </div>
                </div>

                <!-- ── Section 7 ── -->
                <div class="nx-section" id="s7">
                    <div class="nx-section-header">
                        <div class="nx-section-num">07</div>
                        <h2 class="nx-section-title">Vos droits RGPD</h2>
                    </div>
                    <p>Conformément au RGPD, vous disposez des droits suivants sur vos données personnelles :</p>
                    <div class="nx-rights">
                        <span class="nx-right-pill"><i class="bi bi-eye"></i> Accès</span>
                        <span class="nx-right-pill"><i class="bi bi-pencil"></i> Rectification</span>
                        <span class="nx-right-pill"><i class="bi bi-trash"></i> Effacement</span>
                        <span class="nx-right-pill"><i class="bi bi-slash-circle"></i> Opposition</span>
                        <span class="nx-right-pill"><i class="bi bi-pause-circle"></i> Limitation</span>
                        <span class="nx-right-pill"><i class="bi bi-box-arrow-right"></i> Portabilité</span>
                        <span class="nx-right-pill"><i class="bi bi-person-x"></i> Décision automatisée</span>
                        <span class="nx-right-pill"><i class="bi bi-moon-stars"></i> Post-mortem</span>
                    </div>
                    <p class="mt-3">Pour exercer ces droits, contactez notre DPO à <strong style="color:var(--nx-blue)">dpo@todolist.fr</strong> avec une copie d'un justificatif d'identité. Nous répondons dans un délai maximum d'<strong>1 mois</strong> (prolongeable de 2 mois si nécessaire).</p>
                    <p>Si vous estimez que vos droits ne sont pas respectés, vous pouvez introduire une réclamation auprès de la <strong>CNIL</strong> (<a href="https://www.cnil.fr" target="_blank" style="color:var(--nx-blue);text-decoration:none;">www.cnil.fr</a>).</p>
                </div>

                <!-- ── Section 8 ── -->
                <div class="nx-section" id="s8">
                    <div class="nx-section-header">
                        <div class="nx-section-num">08</div>
                        <h2 class="nx-section-title">Sécurité des données</h2>
                    </div>
                    <p>ToDoList met en œuvre des mesures techniques et organisationnelles appropriées pour protéger vos données contre toute perte, accès non autorisé ou divulgation accidentelle :</p>
                    <ul class="nx-list">
                        <li>Chiffrement des données en transit via TLS 1.3 et au repos via AES-256.</li>
                        <li>Mots de passe stockés sous forme hachée (bcrypt, facteur de coût 12).</li>
                        <li>Accès aux données restreint au personnel habilité selon le principe du moindre privilège.</li>
                        <li>Audits de sécurité et tests de pénétration réguliers réalisés par des tiers indépendants.</li>
                        <li>Plan de réponse aux incidents de sécurité avec notification de la CNIL sous 72 h en cas de violation.</li>
                    </ul>
                </div>

                <!-- ── Section 9 ── -->
                <div class="nx-section" id="s9">
                    <div class="nx-section-header">
                        <div class="nx-section-num">09</div>
                        <h2 class="nx-section-title">Modifications de la politique</h2>
                    </div>
                    <p>ToDoList se réserve le droit de modifier la présente politique à tout moment. En cas de modification substantielle, vous serez informé par e-mail ou via une notification dans l'application au moins <strong>30 jours</strong> avant l'entrée en vigueur des changements.</p>
                    <p>La version en vigueur est toujours accessible à l'adresse <a href="/privacy" style="color:var(--nx-blue);text-decoration:none;">todolist.fr/privacy</a>. La date de dernière mise à jour figure en haut de cette page.</p>
                </div>

                <!-- ── Section 10 ── -->
                <div class="nx-section" id="s10">
                    <div class="nx-section-header">
                        <div class="nx-section-num">10</div>
                        <h2 class="nx-section-title">Nous contacter</h2>
                    </div>
                    <p>Pour toute question relative à cette politique ou pour exercer vos droits, contactez-nous via :</p>
                    <div class="row g-3 mt-1">
                        <div class="col-sm-6">
                            <a href="mailto:privacy@todolist.fr" class="nx-contact-card">
                                <div class="nx-contact-icon"><i class="bi bi-shield-lock"></i></div>
                                <div>
                                    <div class="nx-contact-label">Responsable vie privée</div>
                                    <div class="nx-contact-value">privacy@todolist.fr</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="mailto:dpo@todolist.fr" class="nx-contact-card">
                                <div class="nx-contact-icon"><i class="bi bi-person-badge"></i></div>
                                <div>
                                    <div class="nx-contact-label">Délégué à la protection des données</div>
                                    <div class="nx-contact-value">dpo@todolist.fr</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="nx-page-footer">
                    <span>© 2026 ToDoList SAS — Tous droits réservés.</span>
                    <a href="/users/create" class="nx-btn-back">
                        <i class="bi bi-arrow-left"></i> Retour à l'inscription
                    </a>
                </div>

            </div>
            <!-- /col contenu -->

            <!-- ── Sommaire ── -->
            <div class="col-lg-4 nx-toc-col">
                <div class="nx-toc">
                    <div class="nx-toc-title">Sommaire</div>
                    <a href="#s1"  class="nx-toc-link"><span class="nx-toc-num">01</span> Responsable du traitement</a>
                    <a href="#s2"  class="nx-toc-link"><span class="nx-toc-num">02</span> Données collectées</a>
                    <a href="#s3"  class="nx-toc-link"><span class="nx-toc-num">03</span> Bases légales</a>
                    <a href="#s4"  class="nx-toc-link"><span class="nx-toc-num">04</span> Durées de conservation</a>
                    <a href="#s5"  class="nx-toc-link"><span class="nx-toc-num">05</span> Partage des données</a>
                    <a href="#s6"  class="nx-toc-link"><span class="nx-toc-num">06</span> Cookies &amp; traceurs</a>
                    <a href="#s7"  class="nx-toc-link"><span class="nx-toc-num">07</span> Vos droits RGPD</a>
                    <a href="#s8"  class="nx-toc-link"><span class="nx-toc-num">08</span> Sécurité</a>
                    <a href="#s9"  class="nx-toc-link"><span class="nx-toc-num">09</span> Modifications</a>
                    <a href="#s10" class="nx-toc-link"><span class="nx-toc-num">10</span> Nous contacter</a>
                </div>
            </div>

        </div><!-- /row -->
    </div><!-- /wrap-page -->

</div><!-- /nx-root -->
<script>
    /* Barre de progression */
    const bar = document.getElementById('nx-progress');
    window.addEventListener('scroll', () => {
        const doc = document.documentElement;
        bar.style.width = (doc.scrollTop / (doc.scrollHeight - doc.clientHeight) * 100) + '%';
    });

    /* Sommaire actif */
    const sections = document.querySelectorAll('.nx-section');
    const links    = document.querySelectorAll('.nx-toc-link');
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                links.forEach(l => l.classList.remove('active'));
                const a = document.querySelector(`.nx-toc-link[href="#${e.target.id}"]`);
                if (a) a.classList.add('active');
            }
        });
    }, { rootMargin: '-20% 0px -70% 0px' });
    sections.forEach(s => obs.observe(s));
</script>