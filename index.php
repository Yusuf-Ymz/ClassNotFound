<?php
# Start a new session for each connexion from a new browser
session_start();

# Defining constants
define('VIEWS',"views/");
define('MODELS','models/');
define('CONTROLLERS','controllers/');
define('IMAGES','views/images/');
define('TITLE','ClassNotFound');


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
        $nav_action_1 = '';
        $nav_action_2 = 'logout';
    }
}

# Show header view
require_once(VIEWS . 'header.php');

# If action is empty, define action=homepage
if (empty($_GET['action'])) {
    $_GET['action'] = 'homepage';
}

# Create a $controller variable containing the correct controller according to the action
switch ($_GET['action']) {
    case 'login':
        require_once(CONTROLLERS.'LoginController.php');
        $controller = new LoginController();
        break;
    case 'logout':
        require_once(CONTROLLERS.'LogoutController.php');
        $controller = new LogoutController();
        break;
    case 'register':
        require_once(CONTROLLERS.'RegisterController.php');
        $controller = new RegisterController();
        break;
    case 'admin':
        require_once(CONTROLLERS.'AdminController.php');
        $controller = new AdminController();
        break;
    case 'search':
        require_once(CONTROLLERS.'SearchController.php');
        $controller = new SearchController();
        break;
    case 'category':
        require_once(CONTROLLERS.'CategoryController.php');
        $controller = new CategoryController();
        break;
    default:
        require_once(CONTROLLERS.'HomepageController.php');
        $controller = new HomepageController();
        break;
}

# Launch the controller defined by the previous switch statement
$controller->run();

# Show footer view
require_once(VIEWS . 'footer.php');