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
        $researchedQuestionsAuthorsCategories = $this->_db->search_questions_authors_categories($_POST['search']);

        $questions = $researchedQuestionsAuthorsCategories[0];
        $authors = $researchedQuestionsAuthorsCategories[1];
        $categories = $researchedQuestionsAuthorsCategories[2];

        $nbQuestions = count($questions);

        # Show search view
        require_once(VIEWS . 'search.php');
    }
}