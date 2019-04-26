<?php

class CategoryController
{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run(){

        # If no id specified or incorrect id --> redirect to homepage
        if(!isset($_GET['id']) || empty($_GET['id']) || !$this->_db->category_exists($_GET['id'])) {
            header('Location: index.php');
            die();
        }

        $categoryName = $this->_db->select_category($_GET['id'])->name();

        # Select all questions + their respective author from the category with the specified id
        $questions = $this->_db->select_questions_authors($_GET['id']);

        $nbQuestions = count($questions);

        require_once(VIEWS . 'category.php');
    }

}