<div class="container">
    <h3>Results:</h3>
</div>
<?php if($nbQuestions == 0) echo '<p id="notification" class="container"><i class="fas fa-exclamation-triangle"></i> No results.</p>'?>
<?php for ($i = 0; $i < $nbQuestions; $i++) { ?>
    <div class="container">
        <div class="card">
            <div class="card-body">

                <div class="row card-deco">

                    <!-- Here we are searching the author's firstname to display it -->
                    <span class="col-6 font-weight-bold">
                        <?php echo $authors[$i]->html_login().' asks:' ?>
                    </span>

                    <!-- Searching the question's category to display as well-->
                    <span class="col-6 font-weight-bold red categoryQuestions pagination justify-content-end">
                    <?php echo $categories[$i]->name(); ?>
                    </span>

                </div>

                <!-- Displaying the title of the question-->
                <a href="index.php?action=question&id=<?php echo $questions[$i]->questionId(); ?>"
                   class="list-group-item questions">
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
