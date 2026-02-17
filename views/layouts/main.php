<?php

use App\Core\Auth;

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $titre ?? "WizardFrameworks" ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>
    <body>
    <?php if($_SERVER["REQUEST_URI"] != "/login"): ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users">Liste utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/form">Création utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/roles">Liste des rôles</a>
                    <li class="nav-item">
                        <a class="nav-link" href="/roles/form">Créer un nouveau rôle</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/articles">Liste des articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/doc">Doc</a>
                    </li>
                    <li class="nav-item">
                        <?php if (Auth::check()){
                            $actionuri = "/logout";
                            $boutton = "Deconnexion";
                        }else{
                            $actionuri = "/login";
                            $boutton = "Connexion";
                        }
                        ?>
                        <a class="nav-link" href= "<?= $actionuri?>"> <?= $boutton?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php endif; ?>
    <?php
    if ($messages){
        foreach ($messages as $type => $message){
            foreach($message as $messageValue){?>
                <div class=" alert alert-<?=$type?>" role="alert">
                    <?= $messageValue ?>
                </div>
    <?php }}} ?>
    <!-- ICI CHARGEMENT DE LA VUE (CONTENT) -->
    <?php $content ? require $content : ""; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>