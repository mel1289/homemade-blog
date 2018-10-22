<?php

function user_is_logged ()
{
    return isset($_SESSION['logged']);
}

function dd ($msg)
{
    if ($GLOBALS['debug'])
        echo '<pre>', print_r($msg), '</pre>';
}