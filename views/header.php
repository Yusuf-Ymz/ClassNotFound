<!DOCTYPE html>
<html lang="en">
<head>
    <title>ClassNotFound</title>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="<?php echo IMAGES ?>favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo VIEWS ?>css/style.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?action=accueil">
                <i class="far fa-comment-alt"></i>
                <?php echo " " . TITLE ?>
            </a>
        </div>
        <div class="container-fluid">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=<?php echo $nav_action_1 ?>"><?php echo $nav_item_1 ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=<?php echo $nav_action_2 ?>"><?php echo $nav_item_2 ?></a>
                </li>
            </ul>
        </div>
    </nav>
</header>