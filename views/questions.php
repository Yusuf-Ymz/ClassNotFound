<div class="container">
    <h3>
        <?php
        if (isset($category)) {
            echo $category->name() . " Questions:";
        } elseif (isset($_POST['form_search'])) {
            echo 'Results:';
        } else echo 'Newest Questions';
        ?>
    </h3>
</div>
<?php
if ($nbQuestions == 0) {
    echo '<p id="notification" class="container"><i class="fas fa-exclamation-triangle"></i>';
    if (isset($category)) {
        echo ' No questions have been posted in this category yet.';
    } elseif (isset($_POST['form_search'])) {
        echo ' No results';
    } else echo ' No open questions have been found</p>';
}
?>
<!-- Displaying category's questions -->
<?php for ($i = 0; $i < $nbQuestions; $i++) { ?>
    <div class="container">
        <div class="card">
            <div class="card-body">

                <!-- Here we are searching the author's firstname to display it -->
                <span class="font-weight-bold">
                    <?php echo $questions[$i]->author()->html_login() . ' asks:' ?>
                </span>

                <!-- Displaying the title of the question-->
                <a href="index.php?action=question&id=<?php echo $questions[$i]->questionId(); ?>"
                   class="list-group-item categoryQuestions">
                    <?php echo $questions[$i]->html_title() ?>
                </a>

                <!-- Displaying the question's publication date -->
                <span class="card-deco pagination justify-content-end">
                    <?php echo $questions[$i]->publicationDate() ?>
                </span>

            </div>
        </div>
    </div>
<?php } ?>
