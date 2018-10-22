<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <title>Ma vie d'étudiant - Actualités</title>

        <link rel="stylesheet" href="ressources/style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="ressources/tinymce/tinymce.min.js"></script>

    </head>

    <body>

        <h1>Ma vie d'étudiant 😲😁😂</h1>
        <p>Blog nourrit à base d'hyprocrisie et d'ironie 🛀</p>

        <div class="nav">
            <?php if (user_is_logged ()): ?>

            <a href="?p=home">Actualités</a>
            <a href="?p=profil">Mon compte</a>
            <a href="?p=logout">Déconnexion</a>
            <div style="font-weight: bold; float: right;">Hi <?= $user->getLogin() ?> !</div>

            <?php if ($user->isAdmin ()): ?>
            <hr>
            
            <div class="admin-nav-link">
                Raccourcis admin: <a href="?p=admin_post">Gérer les articles</a>
            </div>
            <?php endif; ?>

            <?php else: ?>

            <a href="?p=home">Homepage</a>
            <a href="?p=login">Login</a>
            <a href="?p=register">Register</a>

            <?php endif; ?>
        </div>

        <?= $content ?>

        <center>
            <a href="?p=admin">Accéder au panneau d'administration</a>
        </center>

    </body>
</html>