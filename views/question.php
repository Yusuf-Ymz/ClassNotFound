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
                <div class="container col-4 pagination justify-content-end" id="question-date">
                    <p class="card-login"><?php echo $question->publicationDate() ?></p>
                </div>
            </div>

        </div>

        <!-- Displaying the question's title and question's subject -->
        <div class="card-body">
            <h5 id="question-title" class="card-title"><?php echo $question->html_title();
                if ($question->state() == 'duplicated') {
                    echo " [DUPLICATE]";
                } ?></h5>
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
                                <button class="btn btn-dark" type="submit" name="state">Open</button>
                            </form>
                        <?php } else { ?>
                            <form class="form-btn" action="index.php?action=duplicateQuestion" method="post">
                                <input type="hidden" name="question_id" value="<?php echo $question->questionId(); ?>">
                                <button class="btn btn-dark" type="submit" name="state">Duplicate</button>
                            </form>
                        <?php } ?>
                        <form class="form-btn" action="index.php?action=deleteQuestion" method="post">
                            <input type="hidden" name="question_id" value="<?php echo $question->questionId(); ?>">
                            <button class="btn btn-dark" type="submit" name="delete">Delete</button>
                        </form>
                    <?php } ?>
                    <?php if (isset($_SESSION['login']) && $_SESSION['login'] == $authorLogin) { ?>
                        <form class="form-btn" action="index.php?action=editQuestion" method="post">
                            <input type="hidden" name="question_id" value="<?php echo $question->questionId(); ?>">
                            <button class="btn btn-dark" type="submit" name="edit">Edit</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Displaying notification in case of duplicate question -->
<?php if (isset($notification)) { ?>
    <div class="container" id="notification"><?php echo $notification; ?> </div>
<?php } ?>

<!-- Displaying all question's answers -->
<?php for ($i = 0; $i < $nbAnswers; $i++) { ?>
    <!-- Displaying the best answer on top if there is one -->
    <?php if ($i == 0 && $answers[0] != null) { ?>
        <div class="container">
            <h3>Best Answer:</h3>
        </div>
    <?php } elseif ($i == 0) { ?>
        <div class="container">
            <h3>Answers:</h3>
        </div>
        <?php continue;
    } ?>
    <div class="container" id="<?php echo $answers[$i]->answerId(); ?>">
        <div class="card">
            <!-- Displaying answer's author -->
            <div class="card-header">
                <p class="card-text card-login font-weight-bold"><?php echo $answers[$i]->member()->html_login() . ' answers:' ?></p>
            </div>
            <!-- Displaying the answer -->
            <div class="card-body">
                <p class="card-text"><?php echo Utils::html_replace_enter_by_br($answers[$i]->html_subject()); ?></p>
            </div>

            <!-- Displaying answer's votes -->
            <div class="row card-footer question-btn">
                <div class="col-6 likes">
                    <form class="form-btn float-left" action="index.php?action=voteAnswer" method="post">
                        <div class="container card-footer-container">
                            <input type="hidden" name="question_id" value="<?php echo $question->questionId(); ?>">
                            <input type="hidden" name="answer_id" value="<?php echo $answers[$i]->answerId(); ?>">
                            <button class="btn btn-dark" type="submit" name="like"><i
                                        class="fas fa-thumbs-up"></i> <?php echo $answers[$i]->likes(); ?></button>
                            <button class="btn btn-dark" type="submit" name="dislike"><i
                                        class="fas fa-thumbs-down"></i> <?php echo $answers[$i]->dislikes(); ?></button>
                        </div>
                    </form>
                    <?php if ($question->bestAnswerId() == null && isset($_SESSION['login']) && $_SESSION['login'] == $authorLogin) { ?>
                        <form class="form-btn float-left" action="index.php?action=bestAnswer" method="post">
                            <div class="container card-footer-container">
                                <input type="hidden" name="answer_id" value="<?php echo $answers[$i]->answerId() ?>">
                                <input type="hidden" name="question_id" value="<?php echo $question->questionId() ?>">
                                <button class="btn btn-dark" type="submit" name="best_answer"><i
                                            class="far fa-check-circle"></i></button>
                            </div>
                        </form>
                    <?php } ?>
                </div>
                <div class="container card-footer-container col-6">
                    <span id="date" class="card-deco pagination justify-content-end">
                        <?php echo $answers[$i]->publicationDate() ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <?php if ($i == 0) { ?>
        <div class="container">
            <h3>Answers:</h3>
        </div>
    <?php } ?>
<?php } ?>
