<?php

class QuestionController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {

        # If no id specified or incorrect id --> redirect to homepage
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: index.php");
            die();
        }

        # Select the question from the id in $_GET['id']
        $question = $this->_db->select_question($_GET['id']);

        if($question == null){
            header('Location: index.php?action=homepage');
            die();
        }

        $memberId = unserialize($_SESSION['login'])->memberId();

        # Getting the login of the question's author
        $authorLogin = $question->author()->html_login();

        # Getting the question's id
        $questionId = $question->questionId();

        # Getting the question's state
        $questionState = $question->state();

        # Getting the question's best answer
        $bestAnswer = $question->bestAnswer();

        $nbAnswers = count($question->answers());

        if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
            $notification = $_SESSION['error'];
            $_SESSION['error'] = null;
        }

        # If the user clicked on a button
        if (!empty($_POST)) {
            if (isset($_POST['remove_duplicate'])) {
                $this->open_question();
            } # Removing question's duplicate state
            elseif (isset($_POST['delete'])) {
                $this->delete_question();
            } elseif ($questionState == 'duplicated') {
                $notification = 'This question is marked as duplicated';
            } else {
                # Setting the question as duplicate
                if (isset($_POST['duplicate'])) {
                    $this->duplicate();
                } elseif (isset($_POST['like']) || isset($_POST['dislike'])) {
                    # Voting for an answer
                    $result = $this->vote_answer($questionState, $memberId);
                    if ($result != null) $notification = $result;
                } elseif (isset($_POST['delete_best_answer'])) {
                    # Removing the question and all related answers
                    $this->remove_best_answer();
                } else {
                    # Setting the answer as best answer
                    $this->best_answer();
                }
            }
        }

        require_once(VIEWS . 'question.php');

    }

    private function duplicate()
    {
        $this->_db->duplicate_question($_POST['question_id']);
        header('Location: index.php?action=question&id=' . $_POST['question_id']);
        die();
    }

    private function remove_best_answer()
    {
        $this->_db->remove_best_answer($_POST['question_id']);
        header('Location: index.php?action=question&id=' . $_POST['question_id']);
        die();
    }

    private function open_question()
    {
        $this->_db->open_question($_POST['question_id']);

        header('Location: index.php?action=question&id=' . $_POST['question_id']);
        die();
    }

    private function vote_answer($questionState, $memberId)
    {
        # If the user is not logged
        if (!isset($_SESSION['logged'])) {
            $_SESSION['error'] = 'You must be logged to like or dislike an answer';
            header('Location: index.php?action=login');
            die();
        }

        # If the member try to vote for his answer
        if ($memberId == $_POST['member_id']) {
            return 'You cannot vote for your own answers';

        }

        if (isset($_POST['like'])) {
            $vote = 1;
        } else {
            $vote = 0;
        }

        # Trying to insert the member's vote
        try {
            $this->_db->insert_vote($memberId, $_POST['answer_id'], $vote);
            header('Location: index.php?action=question&id=' . $_POST['question_id'] .'#' . $_POST['answer_id']);
            die();
        }# The member has already voted for this answer
        catch (PDOException $e) {
            return 'You already voted for this answer';
        }
    }

    private function delete_question()
    {
        # Removing the question and all related answers
        $this->_db->delete_question($_POST['question_id']);

        # Redirecting to homepage
        header('Location: index.php?action=homepage');
        die();
    }

    private function best_answer()
    {

        # Setting the answer as best answer
        $this->_db->set_as_best_answer($_POST['question_id'], $_POST['answer_id']);

        # This controller is not displaying a view --> redirect to the question page
        header('Location: index.php?action=question&id=' . $_POST['question_id']);
        die();
    }
}