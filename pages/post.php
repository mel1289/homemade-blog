<?php
    if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $_GET['id'] <= 0) {
        header('location: index.php');
    }

    $id = (int) $_GET['id'];

    $data = $postManager->findOnline($id);

    if (!$data) {
        header('location: index.php');
    }

    $post = new App\Post($data);

    if ($_POST) {
        if (!empty($_POST['comment'])) {
            $commentManager->create([
                'user_id'   => $user->getId(),
                'post_id'   => $id,
                'content'   => $_POST['comment']
            ]);

            header('location: ?p=post&id='.$id);
        }
    }
?>

<div class="content">
    <div class="title"><?= $post->getTitle() ?></div>

    <hr>

    <div class="details">Rédigé par <?= $post->getAuthor() ?>, le <?= $post->getPostedAtFormated() ?></div>

    <p>
        <?= $post->getContent() ?>
    </p>
</div>

<h2>Commentaires</h2>

<?php if (user_is_logged ()): ?>
<div class="content">
    <form action="#" method="POST">
        <p class="add-comment">
            <input type="text" name="comment" placeholder="Votre commentaire ...">
        </p>
    </form>
</div>
<?php endif; ?>

<?php
    $comments = $commentManager->get($id);

    foreach ($comments as $comment):
?>

    <div class="content">
        <?= htmlentities($comment->getContent()) ?>
        <hr>
        <b><?= $comment->getAuthor() ?></b> le <?= $comment->getPostedFormat() ?>
    </div>

<?php endforeach; ?>