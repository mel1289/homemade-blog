<?php

session_start();

require 'class/Database.php';
require 'class/FormatDate.trait.php';
require 'class/Post.php';
require 'class/User.php';
require 'class/Comment.php';
require 'class/Manager/PostManager.php';
require 'class/Manager/UserManager.php';
require 'class/Manager/CommentManager.php';
require 'functions.php';

use App\DB;
use App\Post;
use App\User;
use App\Comment;
use App\PostManager;
use App\UserManager;
use App\CommentManager;

$GLOBALS['debug'] = false;

$db = new DB('my_blog');

$postManager = new PostManager($db->getPDO());
$userManager = new UserManager($db->getPDO());
$commentManager = new CommentManager($db->getPDO());

if (user_is_logged ()) {
	$user = new User($userManager->find($_SESSION['logged']));
}

define('ERROR_404', 'pages/404.php');
define('TEMPLATE', 'pages/default.php');

$do = isset($_GET['p']) ? $_GET['p'] : 'home';

$pageList = [
	'home'			=> 'home.php',
	'profil'		=> 'profil.php',
	'post'			=> 'post.php',
	'admin_post'	=> 'admin_post.php',
	'edit_post'		=> 'edit_post.php',
	'delete_post'	=> 'delete_post.php',
	'password'		=> 'password.php',
	'admin'			=> 'admin.php',
	'register'		=> 'register.php',
	'login'			=> 'login.php',
	'logout'		=> 'logout.php',
	'add_post'		=> 'add_post.php'
];

ob_start();

if (array_key_exists($do, $pageList)) {
	foreach ($pageList as $k => $v)
	{
		if ($k === $do) {
			$file = "pages/{$v}";

			if (file_exists($file)) {
				require $file;
			}
			else {
				require ERROR_404;
			}
		}
	}
} else {
	require ERROR_404;
}

$content = ob_get_clean();

require TEMPLATE;