<?php
    if (!user_is_logged ()) {
        header('location: index.php?do=login');
    }
?>

<div class="content">
    <div class="title">Your account</div>

    <hr>

    <h4>Welcome to your profil <?= $user->getLogin() ?> !</h4>

    <ul>
        <li><a href="?p=password">Change my password</a></li>
        <li><a href="#">Statistics</a></li>
    </ul>

</div>