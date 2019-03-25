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
        <a class="navbar-brand" href="index.php?action=homepage">ClassNotFound</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=newQuestion">New Question</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=admin">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 id="categories" class="my-4">Categories</h2>
                <div class="list-group">
                    <a href="index.php?action=category&id=1" class="list-group-item">General</a>
                    <a href="index.php?action=category&id=2" class="list-group-item">Algorithms</a>
                    <a href="index.php?action=category&id=3" class="list-group-item">A.I.</a>
                    <a href="index.php?action=category&id=4" class="list-group-item">Big Data</a>
                    <a href="index.php?action=category&id=5" class="list-group-item">3D Graphics</a>
                    <a href="index.php?action=category&id=6" class="list-group-item">Web</a>
                </div>
            </div>
            <div class="col-md-9">
                <!-- Search form -->
                <form action="index.php?action=search" method="get" id="form-search" class="form-inline">
                    <button id="btn-search" type="submit" class="btn btn-default"><i class="fas fa-search" aria-hidden="true"></i></button>
                    <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search" aria-label="Search">
                </form>