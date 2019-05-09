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
            header('Location: index.php');
            die();
        }
        $memberId = unserialize($_SESSION['login'])->memberId();
        # Selecting all questions related to the memberId
        $memberQuestions = $this->_db->select_questions_for_profile($memberId);

        $nbQuestions = count($memberQuestions);

        require_once(VIEWS . 'profile.php');
    }
}