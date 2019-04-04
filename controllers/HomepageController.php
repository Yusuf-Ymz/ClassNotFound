<?php

class HomepageController
{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run(){

        # Select the newest questions + their respective author and category from the database
        $questionsAuthorsCategories = $this->_db->select_newest_questions_authors_categories();

        $questions = $questionsAuthorsCategories[0];
        $authors = $questionsAuthorsCategories[1];
        $categories = $questionsAuthorsCategories[2];

        $nbQuestions = count($questions);

        require_once(VIEWS . 'homepage.php');
    }
}