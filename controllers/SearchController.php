<?php

class SearchController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {
        # Redirect to homepage
        if (!isset($_POST['search'])) {
            header('Location: index.php');
            die();
        }

        # Default value for $_POST['search'] is '' (if empty string)
        if(preg_match('/^\s*$/', $_POST['search'])) $_POST['search'] = '';

        # Select the question that contains a certain keyword (from the search bar)
        $researchedQuestionsAuthorsCategories = $this->_db->search_questions($_POST['search']);

        $nbQuestions = count($researchedQuestionsAuthorsCategories);

        # Show search view
        require_once(VIEWS . 'search.php');
    }
}