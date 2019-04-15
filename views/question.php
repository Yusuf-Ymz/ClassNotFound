<!-- Question Part -->
<div class="container">
    <h3>Question:</h3>
</div>
<!-- Displaying the question -->
<div class="container">
    <div class="card">

        <!-- Displaying user's login -->
        <div class="card-header">
            <div class="row">
                <div class="container col-8">
                    <p class="card-login font-weight-bold"><?php echo $authorLogin . ' asks:'; ?></p>
                </div>
                <div class="container col-4 pagination justify-content-end">
                    <p class="card-login"><?php echo $question->publicationDate() ?></p>
                </div>
            </div>

        </div>

        <!-- Displaying the question's title and question's subject -->
        <div class="card-body">
            <h5 id="question-title" class="card-title"><?php echo $question->html_title(); ?></h5>
            <p class="card-text"><?php echo Utils::html_replace_enter_by_br($question->html_subject()); ?></p>
        </div>

        <!-- Displaying all question's features -->
        <div class="question-btn card-footer">

            <div class="container">
                <div class="row">
                    <form class="form-btn" action="index.php?action=newAnswer" method="post">
                        <button class="btn btn-dark" type="submit">Answer</button>
                        <input type="hidden" name="id" value="<?php echo $question->questionId(); ?>">
                    </form>

                    <?php if (isset($_SESSION['admin'])) { ?>
                        <?php if ($question->state() == 'duplicated') { ?>
                            <form class="form-btn" action="index.php?action=openQuestion" method="post">
                                <input type="hidden" name="question_id" value="<?php echo $question->questionId(); ?>">
                                <button class="btn btn-dark btn-question" type="submit">Open</button>
                            </form>
                        <?php } else { ?>
                            <form class="form-btn" action="index.php?action=duplicateQuestion" method="post">
                                <input type="hidden" name="question_id" value="<?php echo $question->questionId(); ?>">
                                <button class="btn btn-dark btn-question" type="submit">Duplicate</button>
                            </form>
                        <?php } ?>
                        <form class="form-btn" action="index.php?action=deleteQuestion" method="post">
                            <input type="hidden" name="question_id" value="<?php echo $question->questionId(); ?>">
                            <button class="btn btn-dark btn-question" type="submit">Delete</button>
                        </form>
                    <?php } ?>
                    <?php if (isset($_SESSION['login']) && $_SESSION['login'] == $authorLogin) { ?>
                        <form class="form-btn" action="index.php?action=editQuestion" method="post">
                            <input type="hidden" name="question_id" value="<?php echo $question->questionId(); ?>">
                            <button class="btn btn-dark btn-question" type="submit">Edit</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
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
                <form action="index.php?action=voteAnswer" method="post">
                    <div class="container card-footer-container">
                        <button class="btn btn-dark" type="submit" name"like"><i class="fas fa-thumbs-up"></i><?php echo $answers[$i]->likes() ;?></button>
                        <button class="btn btn-dark btn-question" type="submit" name"dislike"><i class="fas fa-thumbs-down"></i><?php echo $answers[$i]->dislikes() ;?></button>
                    </div>
                </form>
                <div class="container card-footer-container col-9">
                    <span id="date" class="card-deco pagination justify-content-end">
                        <?php echo $answers[$i]->publicationDate() ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

