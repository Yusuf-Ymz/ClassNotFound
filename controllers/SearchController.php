<?php

class SearchController
{
    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run(){

        # Select the question that contains a certain keyword (from the search bar)
        $researchedQuestions = $this->_db->search_questions($_POST['search']);

        # Show search view
        require_once(VIEWS . 'search.php');
    }
}