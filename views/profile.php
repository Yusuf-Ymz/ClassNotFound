<div class="container">
    <h3>My questions:</h3>
</div>
<!-- Displaying all questions -->
<?php foreach ($memberQuestions as $i => $question) { ?>
    <div class="container">
        <div class="card">
            <div class="card-body">
                
                <!-- Displaying the title of the question-->
                <a href="index.php?action=question&id=<?php echo $question->questionId(); ?>"
                   class="list-group-item categoryQuestions">
                    <?php echo $question->html_title() ?>
                </a>

                <!-- Displaying the question's publication date -->
                <span class="card-deco pagination justify-content-end">
                    <?php echo $question->publicationDate() ?>
                </span>

            </div>
        </div>
    </div>
<?php } ?>
