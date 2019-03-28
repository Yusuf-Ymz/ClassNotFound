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
                <?php if(empty($_SESSION['logged'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=register">Register</a>
                </li>
                <?php } ?>
                <?php if(!empty($_SESSION['admin'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=admin">Admin</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=<?php echo empty($_SESSION['logged']) ? 'login">Login' : 'logout">Logout'?></a>
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
                    <?php foreach ($tabCategories as $i => $category) { ?>
                    <a href="index.php?action=category&id=<?php echo $category->html_id(); ?>" class="list-group-item category"><?php echo $category->html_name(); ?></a>
                    <?php } ?>
                </div>
            </div>
            <!-- Main Content + Search bar -->
            <div class="col-md-9">
                <!-- Search form -->
                <div class="container-fluid form-search">
                    <form action="index.php?action=search" method="post">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search" name="search" <?php if(isset($_POST['search'])) echo 'value="' . $_POST['search'] . '"' ?>>
                            <div class="input-group-btn">
                            <button id="btn-search" class="btn btn-default" type="submit" name="form_search"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>