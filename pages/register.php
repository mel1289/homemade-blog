<?php
    if (user_is_logged ()) {
        header('location: index.php');
    }
    
    $errors = [];

    if ($_POST) {
        if (!empty($_POST['login']) && !empty($_POST['password'])) {

            if (strlen($_POST['login']) < 4) {
                $errors['login'] = "Your login must contain more than 4 characters";
            }

            else if (preg_match("#[áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]#", $_POST['login'])) {
                $errors['login'] = "Your nickname must not contain spaces, accent, or special characters!";
            }

            else if ($userManager->exist($_POST['login']) == App\UserManager::ERR_USER_EXIST) {
                $errors['login'] = "This login is already taken!";
            }

            else if (strlen($_POST['password']) < 4) {
                $errors['password'] = "Your password must contain more than 4 characters";
            }

            else if (preg_match("#[áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]#", $_POST['password'])) {
                $errors['password'] = "Your password must not contain spaces, accent, or special characters!";
            }

            else {
                $userManager->register([
                    'login'     => $_POST['login'],
                    'password'  => $_POST['password']
                ]);
    
                $success = "You have successfully created your account!";
            }

        } else {
            if (empty($_POST['login'])) $errors['login'] = "Please fill this field!";
            if (empty($_POST['password'])) $errors['password'] = "Please fill this field!";            
        }
    }
?>

<div class="content">
    <div class="title">Register</div>

    <hr>

    <?php if (!empty($success)): ?>
        <p class="success">
            <?= $success ?>
        </p>
    <?php endif; ?>

    <form action="#" method="POST">

        <p>
            <?php if (isset($errors['login'])): ?>
            <div class="form-error"><?= $errors['login'] ?></div>
            <?php endif; ?>
            <input type="text" name="login" placeholder="Login" />
        </p>

        <p>
            <?php if (isset($errors['password'])): ?>
            <div class="form-error"><?= $errors['password'] ?></div>
            <?php endif; ?>
            <input type="password" name="password" placeholder="Password" />
        </p>

        <p>
            <button type="submit">Create my account!</button>
        </p>

    </form>

</div>