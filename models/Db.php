<?php

class Db
{
    private static $instance = null;
    private $_db;

    private function __construct()
    {
        try {
            $this->_db = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Error: connexion to database failed : ' . $e->getMessage());
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
    public function select_categories()
    {
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
        $query = 'SELECT * FROM questions ORDER BY question_id DESC';
        $ps = $this->_db->prepare($query);
        $ps->execute();
        $questions = array();
        while ($row = $ps->fetch()) {
            $questions[] = new Question($row->question_id, $row->author_id, $row->category_id, $row->best_answer_id, $row->title, $row->subject, $row->state, $row->publication_date);
        }
        return $questions;
    }

    # Select the member corresponding to the 'id' parameter
    public function select_member($member_id)
    {
        $query = 'SELECT * FROM members WHERE member_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $member_id);
        $ps->execute();
        $row = $ps->fetch();
        $member = new Member($row->member_id, $row->login, $row->password, $row->lastname, $row->firstname, $row->mail, $row->admin, $row->suspended);
        return $member;
    }

    # Select the category corresponding to the 'id' parameter
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

    # Select all question from the category corresponding to the 'id' parameter
    public function select_category_questions($category_id)
    {
        $query = 'SELECT * FROM questions WHERE category_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $category_id);
        $ps->execute();
        $questions = array();
        while ($row = $ps->fetch()) {
            $questions[] = new Question($row->question_id, $row->author_id, $row->category_id, $row->best_answer_id, $row->title, $row->subject, $row->state, $row->publication_date);
        }
        return $questions;
    }

    # Select the question corresponding to the 'id' parameter
    public function select_question($question_id)
    {
        $query = 'SELECT * FROM questions WHERE question_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $question_id);
        $ps->execute();
        $row = $ps->fetch();
        $question = new Question($row->question_id, $row->author_id, $row->category_id, $row->best_answer_id, $row->title, $row->subject, $row->state, $row->publication_date);
        return $question;
    }

    # Select the answers of the question corresponding to the 'id' parameter
    public function select_answers($question_id)
    {
        $query = 'SELECT * FROM answers WHERE question_id=:id ORDER BY answer_id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $question_id);
        $ps->execute();
        $answers = array();
        while ($row = $ps->fetch()) {
            $answers[] = new Answer($row->answer_id, $row->author_id, $row->question_id, $row->subject, $row->publication_date);
        }
        return $answers;
    }

    # Verify the password of a login (return null if no such login or incorrect password)
    public function verify_member($login, $password)
    {
        $query = 'SELECT * FROM members WHERE login=:login';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':login', $login);
        $ps->execute();
        $row = $ps->fetch();
        $member = null;
        if(!empty($row)) {
            $member = new Member($row->member_id, $row->login, $row->password, $row->lastname, $row->firstname, $row->mail, $row->admin, $row->suspended);
            if(!password_verify($password, $member->password()))
            {
                $member = null;
            }
        }
        return $member;
    }

    # Return true if the login in parameter exists in the database
    public function login_exists($login)
    {
        $query = 'SELECT * FROM members WHERE login=:login';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':login',$login);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    # Insert a new member in the database
    public function insert_member($lastname, $firstname, $mail, $login, $password)
    {
        $query = 'INSERT INTO members (lastname,firstname,mail,login,password,admin,suspended) VALUES (:lastname,:firstname,:mail,:login,:password,:admin,:suspended)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':lastname',$lastname);
        $ps->bindValue(':firstname',$firstname);
        $ps->bindValue(':mail',$mail);
        $ps->bindValue(':login',$login);
        $ps->bindValue(':password',$password);
        $ps->bindValue(':admin',0);
        $ps->bindValue(':suspended',0);
        $ps->execute();
        return;
    }

    # Search for the keyword in the title of the questions in the database
    public function search_questions($keyword)
    {
        $keyword = strtolower($keyword);
        $query = 'SELECT * FROM questions WHERE LOWER(title) LIKE :keyword';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':keyword', "%$keyword%");
        $ps->execute();
        $researchedQuestions = array();
        while ($row = $ps->fetch()) {
            $researchedQuestions[] = new Question($row->question_id, $row->author_id, $row->category_id, $row->best_answer_id, $row->title, $row->subject, $row->state, $row->publication_date);
        }
        return $researchedQuestions;
    }

    # Verify if the category exists
    public function category_exists($idCategory){
        $query =' SELECT * FROM categories WHERE category_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id',$idCategory);
        $ps->execute();
        return ($ps->rowcount() != 0);

    }

    # Verify if the question exists
    public function question_exists($idQuestion){
        $query =' SELECT * FROM questions WHERE question_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id',$idQuestion);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }
}