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
            header('Location: index.php?action=login');
            die();
        }

        #Question form
        if (isset($_POST['form_question'])) {
            # Check if user is trying to post an empty question
            if (empty($_POST['question_title']) || empty($_POST['question_text'])) {
                $notification = 'Please fill in all fields';
            } else {
                # Insert question into database
                $authorId = $this->_db->select_id($_SESSION['login']);
                $publicationDate = date("Y-m-d");
                $this->_db->insert_question($authorId, $_POST['question_category_id'],$_POST['question_title'],$_POST['question_text'], $publicationDate);
                $postedQuestionId = $this->_db->select_last_posted_question();
                header("Location: index.php?action=question&id=" . "$postedQuestionId");
                die();
            }
        }
        # Selecting all categories for newQuestion form
        $categories = $this->_db->select_categories();

        require_once(VIEWS . 'newQuestion.php');
    }
}