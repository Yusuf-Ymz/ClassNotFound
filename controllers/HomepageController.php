<?php

class HomepageController
{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run(){

        # Select the newest questions + their respective author and category from the database
        $questions = $this->_db->select_newest_questions_for_homepage();

        $nbQuestions = count($questions);

        require_once(VIEWS . 'homepage.php');
    }
}