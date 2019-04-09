<?php

class NewAnswerController
{
    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run(){

        # Redirection to login if not logged
        if(!isset($_SESSION['logged'])) {
            header('Location: index.php?action=login');
            die();
        }

        # Redirection to homepage if user tried to enter url action without clicking answer button
        if (!isset($_POST['id'])) {
            header("Location: index.php");
            die();
        }

        # Answer form
        if(isset($_POST['form_answer'])) {
            if(isset($_POST['answer_text'])) {
                # Check if user is trying to post an empty answer
                if(empty($_POST['answer_text'])) {
                    $notification = 'Your answer cannot be empty!';
                } else {
                    # Insert answer into database
                    $authorId = $this->_db->select_id($_SESSION['login']);
                    $publicationDate = date("Y-m-d");
                    $this->_db->insert_answer($authorId, $_POST['id'], $_POST['answer_text'], $publicationDate);
                    header("Location: index.php?action=question&id=" . $_POST['id']);
                    die();
                }
            }
        }

        # Select the question from the id in $_POST['id'] (hidden input)
        $question = $this->_db->select_question($_POST['id']);

        # Select the login of the question's author
        $authorLogin = $this->_db->select_member($question->authorId())->html_login();

        require_once(VIEWS . 'newAnswer.php');
    }
}