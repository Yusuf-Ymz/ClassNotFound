<?php

class SearchController
{
    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run(){

        # Default value for $_POST['search'] is '' (if not defined)
        if(!isset($_POST['search'])) $_POST['search'] = '';

        # Select the question that contains a certain keyword (from the search bar)
        $researchedQuestions = $this->_db->search_questions($_POST['search']);

        # Show search view
        require_once(VIEWS . 'search.php');
    }
}