<div class="container">
    <h3>My questions:</h3>
</div>
<?php if($nbQuestions == 0) echo '<p id="notification" class="container"><i class="fas fa-exclamation-triangle"></i> No questions have been posted yet.</p>'?>
<!-- Displaying all user's questions -->
<?php for ($i = 0; $i < $nbQuestions; $i++) { ?>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <!-- Searching the question's category to display -->
                <span class="font-weight-bold categoryQuestions ">
            <?php echo $categories[$i]->name(); ?>
            </span>

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
