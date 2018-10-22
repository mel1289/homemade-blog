<?php 
    $posts = $postManager->findAllOnline();
?>

<?php if (empty($posts)): ?>

    <div class="content">
        There is no posts.
    </div>

<?php else: ?>

    <?php foreach($posts as $k => $v): ?>
        <div class="content">
            <div class="title">
                <?= $v->getTitle() ?>            
            </div>

            <hr>
            
            <div class="details">Rédigé par <?= $v->getAuthor() ?>, le <?= $v->getPostedAtFormated() ?></div>

            <p>
                <?= $v->getResumeContent() ?>
            </p>

            <hr>

            <p>
                <a href="?p=post&id=<?= $v->getId() ?>" class="btn-light">Je veux en lire plus !</a>
            </p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>