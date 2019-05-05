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
        #If the user try to duplicate a question without being an admin --> homepage
        if (!isset($_POST['state'])) {
            header('Location: index.php?action=homepage');
            die();
        }

        # Setting the question as duplicate
        $this->_db->duplicate_question($_POST['question_id']);

        # This controller is not displaying a view --> redirect to the question page
        header('Location: index.php?action=question&id='.$_POST['question_id']);
        die();
    }
}