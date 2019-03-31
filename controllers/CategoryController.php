<?php

class CategoryController
{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run(){

        # Select all questions from the category with the specified id
        $categoryQuestions=$this->_db->select_category_questions($_GET['id']);

        require_once(VIEWS . 'category.php');
    }

}