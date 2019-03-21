<?php
# Start a new session for each connexion from a new browser
session_start();

# Defining constants
define('VIEWS', "views/");
define('TITLE','ClassNotFound');
define('IMAGES', 'views/images/');

# Items to show in the navbar as well as their actions (Logged in / Logged out / Logged in as admin)
if(empty($_SESSION['logged'])) {
    $nav_item_1 = 'Register';
    $nav_item_2 = 'Login';
    $nav_action_1 = 'register';
    $nav_action_2 = 'login';
} else {
    if(!empty($_SESSION['admin'])) {
        $nav_item_1 = 'Admin Zone';
        $nav_item_2 = 'Logout';
        $nav_action_1 = 'admin';
        $nav_action_2 = 'logout';
    } else {
        $nav_item_1 = '';
        $nav_item_2 = 'Logout';
        $nav_action_1 = '#';
        $nav_action_2 = 'logout';
    }
}

# Show header view
require_once(VIEWS . 'header.php');