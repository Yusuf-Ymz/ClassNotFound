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
        if (!isset($_GET['id']) || empty($_GET['id']) || !$this->_db->question_exists($_GET['id'])) {
            header("Location: index.php");
            die();
        }

        # Select the question from the id in $_GET['id']
        $question = $this->_db->select_question($_GET['id']);

        # If the question is duplicated and user clicked on an action
        if (isset($_SESSION['error']) && !is_null($_SESSION['error'])) {
            $notification = $_SESSION['error'];
            $_SESSION['error'] = null;
        }

        # Select the login of the question's author
        $authorLogin = $question->author()->html_login();

        # Select the question's id
        $questionId = $question->questionId();

        # Select the question's best answer
        $bestAnswer = $question->bestAnswer();

        $nbAnswers = count($question->answers());

        require_once(VIEWS . 'question.php');
    }
}