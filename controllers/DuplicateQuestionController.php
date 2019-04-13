<?php


class DuplicateQuestionController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {
        #If the user is not an admin or the question doesn't exist--> homepage
        if (!isset($_SESSION['admin']) || !isset($_GET['questionid']) || !$this->_db->question_exists($_GET['questionid'])) {
            header('Location: index.php?action=homepage');
            die();
        }
        # Setting the question as duplicate
        $this->_db->duplicate_question($_GET['questionid']);
        header('Location: index.php?action=homepage');
        die();
    }
}