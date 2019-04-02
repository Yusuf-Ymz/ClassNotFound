<?php

class CategoryController
{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run(){

        # Default value for $_GET['id'] (if not defined)
        if(!isset($_GET['id']) || empty($_GET['id'])) $_GET['id'] = '1';
        # Searching if the category entered exists --> redirect to homepage
        if(!$this->_db->category_exists($_GET['id'])){
            header('Location: index.php?');
            die();
        }
        # Select all questions from the category with the specified id
        $categoryQuestions=$this->_db->select_category_questions($_GET['id']);

        require_once(VIEWS . 'category.php');
    }

}