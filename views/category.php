<div class="container">
    <h3><?php echo $this->_db->select_category($_GET['id'])->name() ?> Questions:</h3>
</div>
<?php if(count($categoryQuestions) == 0) echo '<p id="notification" class="container"><i class="fas fa-exclamation-triangle"></i> No questions have been posted in this category yet.</p>'?>
<?php foreach ($categoryQuestions as $i => $question) { ?>
    <div class="container">
        <div class="card">
            <div class="card-body">

                <!-- Here we are searching the author's firstname to display it -->
                <span class="font-weight-bold">
                    <?php $member = $this->_db->select_member($question->authorId());
                    echo $member->html_firstName().' asks:' ?>
                </span>

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
