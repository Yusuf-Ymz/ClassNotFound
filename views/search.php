<div class="container">
    <h3>Results:</h3>
</div>
<?php foreach ($researchedQuestions as $i => $question) { ?>
    <div class="container">
        <div class="card">
            <div class="card-body">

                <div class="row card-deco">

                    <!-- Here we are searching the author's firstname to display it -->
                    <span class="col-6 font-weight-bold">
                        <?php $member = $this->_db->select_member($question->authorId()); echo $member->html_firstName().' asks:' ?>
                    </span>

                    <!-- Searching the question's category to display as well-->
                    <span class="col-6 font-weight-bold red categoryQuestions pagination justify-content-end">
                    <?php $category = $this->_db->select_category($question->categoryId()); echo $category->name(); ?>
                    </span>

                </div>

                <!-- Displaying the subject of the question-->
                <a href="index.php?action=question&id=<?php echo $question->questionId(); ?>"
                   class="list-group-item questions">
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
