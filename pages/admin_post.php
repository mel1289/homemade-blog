<?php
    if (!user_is_logged () || !$user->isAdmin ()) {
        header('location: index.php');
    }

    $posts = $postManager->findAll();
?>
<div class="content">
    <div class="title">Gestion des articles</div>
    <hr>

    <p>
        <a href="?p=add_post">Ajouter un article</a>
    </p>

    <?php if (empty($posts)) : ?>
        Aucun article.
    <?php else: ?>

    <table id="table">
    <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Etat</th>
        <th>Actions</th>
    </tr>

        <?php foreach ($posts as $k) : ?>
        <tr>
            <td>#<?= $k->getId() ?></td>
            <td><?= $k->getTitle() ?></td>
            <td><?= $k->getAuthor() ?></td>
            <td><?= ($k->getOnline() == 1) ? '<div class="online" title="Publié"></div>' : '<div class="noonline" title="Non publié"></div>'; ?></td>
            <td>
                <a href="?p=edit_post&id=<?= $k->getId() ?>">Modifier</a>
                -
                <a href="?p=delete_post&id=<?= $k->getId() ?>" onclick="return confirm('Êtes-vous sûr de supprimer cet article ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</div>