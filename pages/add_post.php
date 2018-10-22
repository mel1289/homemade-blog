<?php
    if (!user_is_logged () || !$user->isAdmin ()) {
        header('location: index.php');
    }

    if ($_POST) {
        if (!empty($_POST['title']) && !empty($_POST['content'])) {

            $errors = []; 
            $online = 0;

            if (isset($_POST['online']) && $_POST['online'] == 'on')
                $online = 1;

            $r = $postManager->create([
                'title'     => $_POST['title'],
                'author'    => $user->getLogin(),
                'content'   => $_POST['content'],
                'online'    => $online
            ]);

            if ($r) {
                $success = "The post was succesfully added!";
            }

        }
        else {
            if (empty ($_POST['title'])) $errors['title'] = 'This field must be filled';
            if (empty ($_POST['content'])) $errors['content'] = 'This field must be filled';
        }
    }
?>

<div class="content">
    <div class="title">Add a post</div>
    
    <hr>

    <?php if (isset($success)): ?>
        <p class="success">
            <?= $success ?>
        </p>
    <?php endif; ?>
    
    <form action="#" method="POST" class="add-post-form">

    <p>
        <?php if (isset($errors['title'])): ?>
        <div class="form-error"><?= $errors['title'] ?></div>
        <?php endif; ?>
        <input type="text" name="title" placeholder="Title">
    </p>

    <p>
        <?php if (isset($errors['content'])): ?>
        <div class="form-error"><?= $errors['content'] ?></div>
        <?php endif; ?>
        <textarea name="content" placeholder="Content" cols="50" rows="10"></textarea>
    </p>

    <p>
        <label for="online">Mettre l'article en ligne</label>
        <input type="checkbox" name="online">
    </p>

    <p>
        <button type="submit">Submit</button>
    </p>

    </form>
</div>

<script>
tinymce.init({
  selector: 'textarea',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview textcolor',
    'searchreplace visualblocks code fullscreen tinymceEmoji',
    'media table contextmenu paste code wordcount'
  ],
  toolbar: 'tinymceEmoji | insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    'ressources/tinmyce/skins/content.min.css']
});
</script>