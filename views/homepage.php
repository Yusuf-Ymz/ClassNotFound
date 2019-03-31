    <div class="container">
        <h3>Newest Questions:</h3>
    </div>
<?php foreach ($questions as $i => $question) { ?>
    <div class="container">
        <div class="card">
            <div class="card-body">

                <div class="row card-deco">

                <!-- Here we are searching the author's firstname to display it -->
                <span class="col-6 font-weight-bold">
                    <?php $member = $this->_db->select_member($question->getAuthorId());
                    echo $member->html_firstName().' asks:' ?>
                </span>

                <!-- Searching the question's category to display as well-->
                <span class="col-6 font-weight-bold red categoryQuestions pagination justify-content-end">
                    <?php
                    $category = $this->_db->select_category($question->getCategoryId());
                    echo $category->name();
                    ?>
                </span>

                </div>

                <!-- Displaying the subject of the question-->
                <a href="index.php?action=question&id=<?php echo $question->getQuestionId(); ?>"
                   class="list-group-item questions">
                    <?php echo $question->getSubject() ?>
                </a>

                <!-- Displaying the question's publication date -->
                <span class="card-deco pagination justify-content-end">
                    <?php echo $question->getDatePublication() ?>
                </span>

            </div>
        </div>
    </div>
<?php } ?>