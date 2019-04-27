<?php


class OpenQuestionController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {
        #If the user try to open a question without being an admin --> homepage
        if (!isset($_POST['state']) && !isset($_POST['delete_best_answer'])) {
            header('Location: index.php?action=homepage');
            die();
        }

        if (isset($_POST['state'])) {
            # Setting the question as open
            if (isset($_POST['delete_best_answer'])) {
                $this->_db->change_question_state($_POST['question_id'], 'solved');
            } else {
                $this->_db->change_question_state($_POST['question_id'], null);
            }
            header('Location: index.php?action=question&id=' . $_POST['question_id']);
            die();
        }

        # Selecting the question
        $question = $this->_db->select_question($_POST['question_id']);

        # If the question is duplicated and user clicked on like or dislike
        if ($question->state() == 'duplicated') {
            $_SESSION['error'] = 'This question is marked as duplicated';

        } else {
            $this->_db->delete_best_answer($_POST['question_id']);
        }
        header('Location: index.php?action=question&id=' . $_POST['question_id']);
        die();
    }
}