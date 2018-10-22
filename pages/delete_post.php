<?php
    if (!user_is_logged () || !$user->isAdmin ()) {
        header('location: index.php');
    }

    if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $_GET['id'] <= 0) {
        header('location: ?p=admin_post');
    }

    $id = (int) $_GET['id'];

    $post = $postManager->find($id);

    if (empty($post)) {
        header('location: ?p=admin_post');
    }

    $postManager->delete($id);
    header('location: ?p=admin_post');
?>