<?php


class ProfileController
{

    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {

        # User not connected --> redirect homepage
        if (!isset($_SESSION['logged'])) {
            header('Location: index.php?action=homepage');
            die();
        }
        $memberId = $this->_db->select_id($_SESSION['login']);
        # Selecting all questions related to the memberId
        $memberQuestions = $this->_db->select_member_questions_categories($memberId);
        $questions = $memberQuestions[0];
        $categories = $memberQuestions[1];
        $nbQuestions = count($questions);
        require_once(VIEWS . 'profile.php');
    }
}