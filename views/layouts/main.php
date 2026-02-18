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
</html>