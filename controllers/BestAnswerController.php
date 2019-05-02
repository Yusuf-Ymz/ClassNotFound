<?php

class BestAnswerController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {
        # If the user didn't clicked  --> homepage
        if(!isset($_POST['best_answer'])){
            header('Location: index.php?action=homepage');
            die();
        }

        # Selecting the question
        $question = $this->_db->select_question_for_best_answer($_POST['question_id']);

        # If the question is duplicated and user clicked on like or dislike
        if ($question->state() == 'duplicated') {
            $_SESSION['error'] = 'This question is marked as duplicated';
            header('Location: index.php?action=question&id=' . $question->questionId());
            die();
        }

        $this->_db->set_as_best_answer($_POST['question_id'],$_POST['answer_id']);
        header('Location: index.php?action=question&id='.$_POST['question_id']);
        die();
    }
}