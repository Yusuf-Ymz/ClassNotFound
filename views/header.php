<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo TITLE ?> - You've got a question ? We've got you covered !</title>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="<?php echo IMAGES ?>favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css">
    <link rel="stylesheet" href="<?php echo VIEWS ?>CSS/style.css">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php?action=homepage"><i class="far fa-comment-alt"></i> ClassNotFound</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=newQuestion">New Question</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=<?php echo $nav_action_1 ?>"><?php echo $nav_item_1 ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=<?php echo $nav_action_2 ?>"><?php echo $nav_item_2 ?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<section id="main">
    <div class="container">
        <div class="row">
            <!-- Categories Menu -->
            <div class="col-md-3">
                <h3 id="categories" class="my-4">Categories</h3>
                <div class="list-group">
                    <a href="index.php?action=category&id=1" class="list-group-item category">General</a>
                    <a href="index.php?action=category&id=2" class="list-group-item category">Algorithms</a>
                    <a href="index.php?action=category&id=3" class="list-group-item category">A.I.</a>
                    <a href="index.php?action=category&id=4" class="list-group-item category">Big Data</a>
                    <a href="index.php?action=category&id=5" class="list-group-item category">3D Graphics</a>
                    <a href="index.php?action=category&id=6" class="list-group-item category">Web</a>
                </div>
            </div>
            <!-- Main Content + Search bar -->
            <div class="col-md-9">
                <!-- Search form -->
                <div class="container-fluid form-search">
                    <form action="index.php?action=search" method="post">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search" name="search" value="<?php if(isset($_POST['search'])) echo $_POST['search'] ?>">
                            <div class="input-group-btn">
                            <button id="btn-search" class="btn btn-default" type="submit" name="form_search"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>