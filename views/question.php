<!-- Question Part -->
<div class="container">
    <h3>Question:</h3>
</div>
<!-- Displaying the question -->
<div class="container">
    <div class="card">

        <!-- Displaying user's login -->
        <div class="card-header">
            <p class="card-login font-weight-bold"><?php echo $author->html_login() . ' asks:'; ?></p>
        </div>

        <!-- Displaying the question's title and question's subject -->
        <div class="card-body">
            <h5 id="question-title" class="card-title"><?php echo $question->html_title(); ?></h5>
            <p class="card-text"><?php echo Utils::html_replace_enter_by_br($question->html_subject()); ?></p>
        </div>

        <hr class="separator">

        <!-- Displaying all question's features -->
        <div class="question-btn card-body">
            <button class="btn btn-dark">Answer</button>
            <?php echo isset($_SESSION['admin']) ? '<button class="btn btn-dark btn-question">Duplicated</button>' : '' ?>
        </div>
    </div>
</div>

<!-- Answers Part -->
<div class="container">
    <h3>Answers:</h3>
</div>
<!-- Displaying all question's answers -->
<?php foreach ($answers as $i => $answer) { ?>
    <!-- Searching answer's author_id -->
    <?php $answer_author = $this->_db->select_member($answer->authorId()) ?>
    <div class="container">
        <div class="card">

            <!-- Displaying answer's author -->
            <div class="card-header">
                <p class="card-text card-login font-weight-bold"><?php echo $answer_author->html_login() . ' answers:' ?></p>
            </div>

            <!-- Displaying the answer -->
            <div class="card-body">
                <p class="card-text"><?php echo Utils::html_replace_enter_by_br($answer->html_subject()); ?></p>
            </div>

            <hr class="separator">

            <!-- Displaying answer's votes -->
            <div class="card-body question-btn">
                <button class="btn btn-dark"><i class="fas fa-thumbs-up"></i> 511</button>
                <button class="btn btn-dark btn-question"><i class="fas fa-thumbs-down"></i> 27</button>
            </div>
        </div>
    </div>
<?php } ?>

