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
        
        # Select all questions from the category with the specified id
        $categoryQuestions=$this->_db->select_category_questions($_GET['id']);

        require_once(VIEWS . 'category.php');
    }

}