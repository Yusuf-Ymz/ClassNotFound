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
        # Trying to access without clicking --> redirect homepage
        if (!isset($_POST['like']) && !isset($_POST['dislike'])) {
            header('Location: index.php');
            die();
        }

        # If the user is not logged
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

        # Trying to insert the member's vote
        try {
            $this->_db->insert_vote($memberId, $_POST['answer_id'], $vote);
        }# The member has already voted for this answer
        catch (PDOException $e) {
            $_SESSION['error'] = 'You already voted for this answer';
            header('Location: index.php?action=question&id=' . $question->questionId());
            die();
        }

        # This controller is not displaying a view --> redirect to the question page
        header('Location: index.php?action=question&id=' . $question->questionId() . '#' . $_POST['answer_id']);
        die();
    }
}