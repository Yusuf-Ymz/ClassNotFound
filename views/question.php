<div class="container">
    <div class="row">
        <div class="col-md-10">
            <p><?php echo $author->html_login(); ?></p>
            <p><?php echo $question->html_title(); ?></p>
            <p><?php echo Utils::html_replace_enter_by_br($question->html_subject()); ?></p>
        </div>
        <div class="col-md-2">
            <button class="btn btn-dark btn-question">Answer</button>
            <button class="btn btn-dark btn-question">Duplicated</button>
        </div>
    </div>
    <div class="container">
        <?php foreach ($answers as $i => $answer) { ?>
        <?php $answer_author = $this->_db->select_member($answer->authorId())?>
            <p><?php echo $answer_author->html_login() ?></p>
            <p><?php echo Utils::html_replace_enter_by_br($answer->html_subject()); ?></p>
        <?php } ?>
    </div>
</div>
