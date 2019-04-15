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
        if (!isset($_POST['question_id'])) {
            header('Location: index.php?action=homepage');
            die();
        }
        # Setting the question as open
        $this->_db->open_question($_POST['question_id']);
        header('Location: index.php?action=question&id='.$_POST['question_id']);
        die();
    }
}