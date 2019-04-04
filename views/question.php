<!-- Question Part -->
<div class="container">
    <h3>Question:</h3>
</div>
<!-- Displaying the question -->
<div class="container">
    <div class="card">

        <!-- Displaying user's login -->
        <div class="card-header">
            <p class="card-login font-weight-bold"><?php echo $authorLogin . ' asks:'; ?></p>
        </div>

        <!-- Displaying the question's title and question's subject -->
        <div class="card-body">
            <h5 id="question-title" class="card-title"><?php echo $question->html_title(); ?></h5>
            <p class="card-text"><?php echo Utils::html_replace_enter_by_br($question->html_subject()); ?></p>
        </div>

        <!-- Displaying all question's features -->
        <div class="question-btn card-footer">
            <button class="btn btn-dark">Answer</button>
            <?php echo isset($_SESSION['admin']) ? '<button class="btn btn-dark btn-question">Duplicated</button>
                                                    <button class="btn btn-dark btn-question">Delete</button>' : '' ?>
            <?php echo (isset($_SESSION['login']) && $_SESSION['login'] == $authorLogin) ? '<button class="btn btn-dark btn-question">Edit</button>' : '' ?>
        </div>
    </div>
</div>

<!-- Answers Part -->
<div class="container">
    <h3>Answers:</h3>
</div>
<!-- Displaying all question's answers -->
<?php for ($i = 0; $i < $nbAnswers; $i++) { ?>
    <div class="container">
        <div class="card">

            <!-- Displaying answer's author -->
            <div class="card-header">
                <p class="card-text card-login font-weight-bold"><?php echo $authors[$i]->html_login() . ' answers:' ?></p>
            </div>

            <!-- Displaying the answer -->
            <div class="card-body">
                <p class="card-text"><?php echo Utils::html_replace_enter_by_br($answers[$i]->html_subject()); ?></p>
            </div>

            <!-- Displaying answer's votes -->
            <div class="row card-footer question-btn">
                <div class="container card-footer-container col-6">
                    <button class="btn btn-dark"><i class="fas fa-thumbs-up"></i> 511</button>
                    <button class="btn btn-dark btn-question"><i class="fas fa-thumbs-down"></i> 27</button>
                </div>
                <div class="container card-footer-container col-6">
                    <span id="date" class="card-deco pagination justify-content-end">
                        <?php echo $answers[$i]->publicationDate() ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

