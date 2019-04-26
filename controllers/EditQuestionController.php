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
        # If the user try to edit without being the question's author or is not logged --> homepage
        if (!isset($_POST['edit']) && !isset($_POST['form_edit'])) {
            header('Location: index.php?action=homepage');
            die();
        }

        # Clicked on submit and if there is an empty field in the form
        if (isset($_POST['question_title']) && isset($_POST['question_subject'])) {
            //if (trim($_POST['question_title']) === '' || trim($_POST['question_subject']) === '') {
            if (preg_match('/^\s*$/', $_POST['question_title']) || preg_match('/^\s*$/', $_POST['question_subject'])) {
                $notification = "Please fill in all fields";
            } # If not update question's title subject and category
            else {
                $this->_db->edit_question($_POST['question_id'], $_POST['question_title'], $_POST['question_subject'], $_POST['question_category_id']);
                header('Location: index.php?action=question&id=' . $_POST['question_id']);
                die();
            }
        }

        # Selecting the question to edit
        $question = $this->_db->select_question($_POST['question_id']);

        # If the question is duplicated and user clicked on like or dislike
        if ($question->state() == 'duplicated') {
            $_SESSION['error'] = 'This question is marked as duplicated';
            header('Location: index.php?action=question&id=' . $question->questionId());
            die();
        }

        # Selecting all categories for newQuestion form
        $categories = $this->_db->select_categories();

        require_once(VIEWS . 'editQuestion.php');
    }
}