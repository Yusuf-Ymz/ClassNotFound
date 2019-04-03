<!-- Displaying the question -->
<div class="container">
    <div class="card">
        <!-- Displaying user's login and question's title -->
        <div class="card-header">
            <p class="font-weight-bold"><?php echo $author->html_login(); ?></p>
            <h5 class="card-title"><?php echo $question->html_title(); ?></h5>
        </div>
        <!-- Displaying the question's subject -->
        <div class="card-body">
            <p class="card-text"><?php echo Utils::html_replace_enter_by_br($question->html_subject()); ?></p>
        </div>
        <!-- Displaying all question's features -->
        <div class="card-body">
            <button class="btn btn-dark btn-question">Answer</button>
            <?php echo isset($_SESSION['admin']) ? '<button class="btn btn-dark btn-question">Duplicated</button>' : '' ?>
        </div>
    </div>
</div>

<!-- Displaying all question's answers -->
<?php foreach ($answers as $i => $answer) { ?>
    <div class="container">
        <div class="card">
            <!-- Searching answer's author_id -->
            <?php $answer_author = $this->_db->select_member($answer->authorId()) ?>
            <!-- Displaying answer's author -->
            <div class="card-header">
                <p class="font-weight-bold"><?php echo $answer_author->html_login() ?></p>
            </div>
            <!-- Displaying the answer -->
            <div class="card-body">
                <p><?php echo Utils::html_replace_enter_by_br($answer->html_subject()); ?></p>
            </div>
        </div>
    </div>
<?php } ?>

