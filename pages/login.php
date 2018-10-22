<?php
    if (user_is_logged ()) {
        header('location: index.php');
    }
    
    if ($_POST) {
        if (!empty($_POST['login']) && !empty($_POST['password'])) {

            $credentials = [
                'login'     => $_POST['login'],
                'password'  => $_POST['password']
            ];

            $r = $userManager->tryConnect($credentials);

            if ($r == App\UserManager::ERR_USER_LOGIN_FAILED) {
                $error = "Login failed!";
            }

            else {
                $_SESSION['logged'] = $r['id'];
                header('location: index.php');
            }
        }
    }
?>

<div class="content">
    <div class="title">Login</div>

    <hr>

    <?php if (!empty($error)): ?>
        <p class="error">
            <?= $error ?>
        </p>
    <?php endif; ?>

    <form action="#" method="POST">
        <p>
            <input type="text" name="login" placeholder="Login" />
        </p>

        <p>
            <input type="password" name="password" placeholder="Password" />
        </p>

        <p>
            <button type="submit">Submit</button>
        </p>

    </form>
</div>