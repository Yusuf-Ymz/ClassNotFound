<?php

class HomepageController
{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run(){

        # Select the newest questions from the database for the homepage view
        $questions= $this->_db->select_newest_questions();

        require_once(VIEWS . 'homepage.php');
    }
}