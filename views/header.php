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
<header>
    <nav class="navbar navbar-expand navbar-light bg-light fixed-top">
        <div id="brand" class="container-fluid">
            <a class="navbar-brand" href="index.php?action=homepage">
                <i class="far fa-comment-alt"></i>
                <?php echo " " . TITLE ?>
            </a>
        </div>
        <div class="container-fluid">
            <ul class="nav navbar-nav ml-auto">
                <li id="btn-new-question" class="nav-item">
                    <a href="index.php?action=newQuestion" class="btn btn-primary" role="button">New Question</a>
                </li>
                <li id="search-bar" class="nav-item">
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="index.php?action=<?php echo $nav_action_1 ?>"><?php echo $nav_item_1 ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="index.php?action=<?php echo $nav_action_2 ?>"><?php echo $nav_item_2 ?></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Category Left Nav -->
<div class="first-elt sidenav bg-light">
    <a href="index.php?action=category&id=1">GENERAL</a>
    <a href="index.php?action=category&id=2">ALGORITHMS</a>
    <a href="index.php?action=category&id=3">A.I.</a>
    <a href="index.php?action=category&id=4">BIG DATA</a>
    <a href="index.php?action=category&id=5">3D GRAPHICS</a>
    <a href="index.php?action=category&id=6">WEB</a>
</div>

<div class="first-elt main">
    <h2>Sidebar</h2>
    <p>This sidebar is of full height (100%) and always shown.</p>
    <p>Scroll down the page to see the result.</p>
    <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
    <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
    <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
    <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
    <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
    <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
    <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
    <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
    <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
    <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
    <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
    