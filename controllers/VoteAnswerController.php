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
        if (!isset($_POST['like']) && !isset($_POST['dislike'])) {
            header('Location: index.php');
            die();
        }

        if (!isset($_SESSION['logged'])) {
            $_SESSION['error'] = 'You must be logged to like or dislike an answer';
            header('Location: index.php?action=login');
            die();
        }



        # Select the question from the id in $_POST['question_id']
        $question = $this->_db->select_question($_POST['question_id']);


        # If the question is duplicated and user clicked on like or dislike
        if ($question->state() == 'duplicated') {
            $_SESSION['error'] = 'This question is marked as duplicated';
            header('Location: index.php?action=question&id=' . $question->questionId());
            die();
        }

        $memberId = unserialize($_SESSION['login'])->memberId();

        # If the member try to vote for his answer
        if($memberId==$_POST['member_id']){
            header('Location: index.php?action=question&id=' . $question->questionId() . '#'. $_POST['answer_id']);
            die();
        }

        $vote = $this->_db->vote_exists($memberId, $_POST['answer_id']);

        if ($vote == null) {
            if (isset($_POST['like'])) {
                $this->_db->insert_vote($memberId, $_POST['answer_id'], 1);
            } else {
                $this->_db->insert_vote($memberId, $_POST['answer_id'], 0);
            }
        } else {
            if ($vote->liked() == 1) {
                if (isset($_POST['like'])) {
                    $this->_db->delete_vote($memberId, $_POST['answer_id']);
                } else {
                    $this->_db->update_vote($memberId, $_POST['answer_id'], 0);
                }
            } else {
                if (isset($_POST['dislike'])) {
                    $this->_db->delete_vote($memberId, $_POST['answer_id']);
                } else {
                    $this->_db->update_vote($memberId, $_POST['answer_id'], 1);
                }
            }
        }

        header('Location: index.php?action=question&id=' . $question->questionId() . '#'. $_POST['answer_id']);
        die();
    }
}