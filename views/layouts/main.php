<?php

use App\Core\Auth;

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= strip_tags($titre) ?? "ToDoList" ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
        <style>
            :root {
                --violet: #7048E9;
                --cyan:   #1AF3D9;
                --sky:    #7EB5D8;
                --blue:   #406DCF;
            }
            body { background: #0E0C1E; color: #E8E6FF; font-family: 'Segoe UI', sans-serif; }

            /* NAVBAR */
            .navbar { background: #16132E; border-bottom: 1px solid rgba(255,255,255,0.08); }
            .navbar-brand { color: var(--cyan) !important; font-weight: 700; font-size: 1.3rem; }

            /* BOUTONS COMMUNS*/
            .btn-violet  { background: var(--violet) !important; color: #fff !important; border: none; }
            .btn-violet:hover  { background: #5a38cc !important; color: #fff !important; }
            .btn-outline-c { color: var(--cyan) !important; border: 1px solid var(--cyan) !important; background: transparent !important; }
            .btn-outline-c:hover { background: var(--cyan) !important; color: #0E0C1E !important; }
</style>

    </head>
<body>
    <!-- NAV -->
    <nav class="navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="/"/><i class="bi bi-check2-square me-2"></i>ToDoList</a>
            <div class="d-flex gap-2">
                <?php if (Auth::check()): ?>
                    <a href="/tache" class="btn btn-outline-c btn-sm px-3"> Liste des tâches</a>
                    <a href="/logout" class="btn btn-outline-c btn-sm px-3">Se déconnecter</a>
                <?php else: ?>
                    <a href="/login" class="btn btn-outline-c btn-sm px-3">Se connecter</a>
                    <a href="/users/create" class="btn btn-violet btn-sm px-3">S'inscrire</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <!-- Manque de cohérence avec les autres vues -->
    <?php
        if ($messages){
            foreach ($messages as $type => $message){
                foreach($message as $messageValue){?>
                    <div class=" alert alert-<?=$type?>" role="alert">
                        <?= $messageValue ?>
                    </div>
    <?php       }
            }
        }
    ?>
    <!-- ICI CHARGEMENT DE LA VUE (CONTENT) -->
    <?= $content ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>