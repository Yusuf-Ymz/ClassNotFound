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
        # Selecting the question to edit
        if(isset($_POST['edit']) || isset($_POST['form_edit'])) {
            $question = $this->_db->select_question_for_edit($_POST['question_id']);
        } else {
            $question = new Question(null, null, null, null, null, null, null, null, null);
        }

        # Clicked on submit and if there is an empty field in the form
        if (isset($_POST['question_title']) && isset($_POST['question_subject'])) {
            if (preg_match('/^\s*$/', $_POST['question_title']) || preg_match('/^\s*$/', $_POST['question_subject'])) {
                $notification = "Please fill in all fields";
            } else {
                if (isset($_POST['form_edit'])) {
                    $this->_db->edit_question($_POST['question_id'], $_POST['question_title'], $_POST['question_subject'], $_POST['question_category_id']);
                    header("Location: index.php?action=question&id=" . $_POST['question_id']);
                    die();
                } elseif (isset($_POST['form_question'])) {
                    # Insert question into database
                    $authorId = unserialize($_SESSION['login'])->memberId();
                    $publicationDate = date("Y-m-d");
                    $this->_db->insert_question($authorId, $_POST['question_category_id'], $_POST['question_title'], $_POST['question_subject'], $publicationDate);
                    $postedQuestionId = $this->_db->select_last_posted_question();
                    header("Location: index.php?action=question&id=" . $postedQuestionId);
                    die();
                }
            }
        }

        # If the question is duplicated and user clicked on like or dislike
        if ($question->state() == 'duplicated') {
            $_SESSION['error'] = 'This question is marked as duplicated';
            header('Location: index.php?action=question&id=' . $question->questionId());
            die();
        }

        $categories = $this->_db->select_categories();

        require_once(VIEWS . 'editQuestion.php');
    }
}