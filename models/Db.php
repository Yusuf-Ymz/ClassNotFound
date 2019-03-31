<?php

class Db
{
    private static $instance = null;
    private $_db;

    private function __construct()
    {
        try {
            $this->_db = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
            $this->_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        }
        catch (PDOException $e) {
            die('Error: connexion to database failed : '.$e->getMessage());
        }
    }

    # Pattern Singleton
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }


    # ***** Database scripts *****

    # Select all categories
    public function select_categories() {
        $query = 'SELECT * FROM categories ORDER BY category_id ASC';
        $ps = $this->_db->prepare($query);
        $ps->execute();
        $categories = array();
        while ($row = $ps->fetch()) {
            $categories[] = new Category($row->category_id, $row->name);
        }
        return $categories;
    }

    # Select newest questions for the homepage
    public function select_newest_questions()
    {
        $query = 'SELECT * FROM questions ORDER BY date_publication DESC';
        $ps = $this->_db->prepare($query);
        $ps->execute();
        $questions = array();
        while ($row = $ps->fetch()) {
            $questions[] = new Question($row->question_id, $row->author_id, $row->category_id, $row->title, $row->subject, $row->date_publication);
        }
        return $questions;
    }

    # Select the member corresponding to the parameter
    public function select_member($member_id)
    {
        $query = 'SELECT * FROM members WHERE member_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $member_id);
        $ps->execute();
        $row = $ps->fetch();
        $member = new Member($row->member_id, $row->login, $row->lastname, $row->firstname, $row->mail, $row->admin, $row->suspended);
        return $member;
    }

    public function select_category($category_id)
    {
        $query = 'SELECT * FROM categories WHERE category_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $category_id);
        $ps->execute();
        $row = $ps->fetch();
        $category = new Category($row->category_id, $row->name);
        return $category;
    }

    public function select_category_questions($category_id){
        $query = 'SELECT * FROM questions WHERE category_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $category_id);
        $ps->execute();
        $questions = array();
        while ($row = $ps->fetch()) {
            $questions[] = new Question($row->question_id, $row->author_id, $row->category_id, $row->title, $row->subject, $row->date_publication);
        }
        return $questions;
    }
}