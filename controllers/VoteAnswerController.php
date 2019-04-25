<?php


class VoteAnswerController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {

        if(!isset($_POST['like']) && !isset($_POST['dislike'])) {
            header('Location: index.php');
            die();
        }

        # Select the question from the id in $_POST['question_id']
        $question = $this->_db->select_question($_POST['question_id']);

        if(!isset($_SESSION['logged'])){
            header('Location: index.php?action=login');
            die();
        }

        # If the question is duplicated and user clicked on like or dislike
        if ($question->state() == 'duplicated') {
            header('Location: index.php?action=question&id=' . $question->questionId() . '&duplicated=true');
            die();
        }

        $memberId = $this->_db->select_id($_SESSION['login']);

        if ($this->_db->vote_exists($memberId,$_POST['answer_id'])) {
            if (isset($_POST['like'])) {
                $this->_db->insert_vote($memberId, $_POST['answer_id'], 1);
            }else {
                $this->_db->insert_vote($memberId, $_POST['answer_id'], 0);
            }
        }

        header('Location: index.php?action=question&id=' . $question->questionId());
        die();
    }
}