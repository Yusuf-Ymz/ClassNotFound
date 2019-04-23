<?php


class DeleteQuestionController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {
        #If the user try to delete without being an admin --> homepage
        if (!isset($_POST['delete'])) {
            header('Location: index.php?action=homepage');
            die();
        }
        # Removing the question and all related answers
        $this->_db->delete_question($_POST['question_id']);
        header('Location: index.php?action=homepage');
        die();
    }
}