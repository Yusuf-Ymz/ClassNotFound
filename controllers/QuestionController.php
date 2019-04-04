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

        # Select the login of the question's author
        $authorLogin = $this->_db->select_member($question->authorId())->html_login();

        # Select the question's answers + their respective author
        $answersAuthors = $this->_db->select_answers_authors($_GET['id']);

        $answers = $answersAuthors[0];
        $authors = $answersAuthors[1];

        $nbAnswers = count($answers);

        require_once(VIEWS . 'question.php');
    }
}