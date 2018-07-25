<?php

if( isset($_COOKIE['user']) ) {
    unset($_COOKIE['user']);
    setcookie('user', '', -1, '/');
}

header('Location: index.php');
