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
        # Clicked on submit and if there is an empty field in the form
        if (isset($_POST['question_title']) && isset($_POST['question_subject'])) {
            if (empty($_POST['question_title']) || empty($_POST['question_subject'])) {
                $notification = "Please fill in all fields";
            } # If not update question's title subject and category
            else {
                $this->_db->edit_question($_POST['question_id'], $_POST['question_title'], $_POST['question_subject'], $_POST['question_category_id']);
                header('Location: index.php?action=question&id=' . $_POST['question_id']);
                die();
            }
        }

        # If the user try to edit without being the question's author or is not logged --> homepage
        if (!isset($_SESSION['logged']) || !isset($_POST['question_id'])) {
            header('Location: index.php?action=homepage');
            die();
        }

        # Selecting the question to edit
        $question = $this->_db->select_question($_POST['question_id']);

        # If the question is duplicated displaying the notification
        if($question->state()=='duplicated'){
            header('Location: index.php?action=question&id='.$_POST['question_id'].'&duplicated=true');
            die();
        }

        # Selecting all categories for newQuestion form
        $categories = $this->_db->select_categories();

        require_once(VIEWS . 'editQuestion.php');
    }
}