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

        # If no id specified --> redirect to homepage
        if(!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: index.php");
            die();
        }

        # Select the question from the id in $_GET['id']
        $question = $this->_db->select_question($_GET['id']);

        # Select the question's answers
        $answers = $this->_db->select_answers($_GET['id']);

        # Select the author of the question
        $author = $this->_db->select_member($question->authorId());

        require_once(VIEWS . 'question.php');
    }
}