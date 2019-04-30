<?php

class NewQuestionController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {
        # If the user is not connected --> login
        if (!isset($_SESSION['logged'])) {
            $_SESSION['error'] = 'You must be logged to post a question';
            header('Location: index.php?action=login');
            die();
        }

        #Question form
        if (isset($_POST['form_question'])) {
            # Check if user is trying to post an empty question
            if (preg_match('/^\s*$/', $_POST['question_title']) || preg_match('/^\s*$/', $_POST['question_subject'])) {
                $notification = "Please fill in all fields";
            } else {
                # Insert question into database
                $authorId = unserialize($_SESSION['login'])->memberId();
                $publicationDate = date("Y-m-d");
                $this->_db->insert_question($authorId, $_POST['question_category_id'],$_POST['question_title'],$_POST['question_subject'], $publicationDate);
                $postedQuestionId = $this->_db->select_last_posted_question();
                header("Location: index.php?action=question&id=" . $postedQuestionId);
                die();
            }
        }

        $categories = $this->_db->select_categories();

        require_once(VIEWS . 'newQuestion.php');
    }
}