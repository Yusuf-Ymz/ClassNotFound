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
        if ($memberId == $_POST['member_id']) {
            $_SESSION['error'] = 'You cannot vote for your own answers';
            header('Location: index.php?action=question&id=' . $question->questionId());
            die();
        }

        if (isset($_POST['like'])) {
            $vote = 1;
        } else {
            $vote = 0;
        }
        try {
            $this->_db->insert_vote($memberId, $_POST['answer_id'], $vote);
        } catch (PDOException $e) {
            $_SESSION['error'] = 'You already voted for this answer';
            header('Location: index.php?action=question&id=' . $question->questionId());
            die();
        }


        header('Location: index.php?action=question&id=' . $question->questionId() . '#' . $_POST['answer_id']);
        die();
    }
}