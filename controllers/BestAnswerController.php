<?php

class BestAnswerController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run(){
        # If the user didn't clicked  --> homepage
        if(!isset($_POST['answer_id'])){
            header('Location: index.php?action=homepage');
            die();
        }
        $this->_db->best_answer($_POST['question_id'],$_POST['answer_id']);
        header('Location: index.php?action=question&id='.$_POST['question_id']);
        die();
    }
}