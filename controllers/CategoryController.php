<?php

class CategoryController
{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run(){

        # If no id specified  --> redirect to homepage
        if(!isset($_GET['id']) || empty($_GET['id'])) {
            header('Location: index.php');
            die();
        }

        # Selecting the category
        $category = $this->_db->select_category($_GET['id']);

        # If the category doesn't exist redirecting to homepage
        if($category == null){
            header('Location: index.php');
            die();
        }

        # Select all questions + their respective author from the category with the specified id
        $questions = $this->_db->select_questions_for_category($_GET['id']);

        $nbQuestions = count($questions);

        require_once(VIEWS . 'category.php');
    }

}