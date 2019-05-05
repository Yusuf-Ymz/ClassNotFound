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

        # If the question is duplicated and user question's author clicked on best answer button --> displaying error
        if ($question->state() == 'duplicated') {
            $_SESSION['error'] = 'This question is marked as duplicated';
            header('Location: index.php?action=question&id=' . $question->questionId());
            die();
        }

        # Setting the answer as best answer
        $this->_db->set_as_best_answer($_POST['question_id'],$_POST['answer_id']);

        # This controller is not displaying a view --> redirect to the question page
        header('Location: index.php?action=question&id='.$_POST['question_id']);
        die();
    }
}