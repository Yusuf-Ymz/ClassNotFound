<?php


class EditQuestionController
{

    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {
        # Clicked on submit
        if (!empty($_POST)) {
            # If there is an empty field in the form
            if (empty($_POST['question_title']) || empty($_POST['question_subject'])) {
                $notification = "Please fill in all fields";
            }
            # If not update question's title subject and category
            else {
                $this->_db->edit_question($_GET['questionid'], $_POST['question_title'], $_POST['question_subject'], $_POST['question_category_id']);
                header('Location: index.php?action=question&id=' . $_GET['questionid']);
                die();
            }
        }
        # If the user is not logged , not the question's author or if the question doesn't exist --> homepage
        if (!isset($_SESSION['logged']) || !isset($_GET['questionid']) || !isset($_GET['authorid']) || $this->_db->select_id($_SESSION['login']) != $_GET['authorid'] || !$this->_db->question_exists($_GET['questionid'])) {
            header('Location: index.php?action=homepage');
            die();
        }

        # Selecting the question to edit
        $question = $this->_db->select_question($_GET['questionid']);

        # Selecting all categories for newQuestion form
        $categories = $this->_db->select_categories();

        require_once(VIEWS . 'editQuestion.php');
    }
}