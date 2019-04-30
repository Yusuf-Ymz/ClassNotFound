<?php

class Db
{
    private static $instance = null;
    private $_db;

    private function __construct($ini)
    {
        try {
            $this->_db = new PDO('mysql:host=localhost;dbname=' . $ini['db_name'] . ';charset=utf8', $ini['db_user'], $ini['db_password']);
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Error: connexion to config failed : ' . $e->getMessage());
        }
    }

    # Pattern Singleton
    public static function getInstance($ini)
    {
        if (is_null(self::$instance)) {
            self::$instance = new Db($ini);
        }
        return self::$instance;
    }


    # ***** Database scripts *****

    # Select all categories (index.php)
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


    public function select_newest_answer($authorId)
    {
        $query = 'SELECT MAX(A.answer_id) as \'max\' FROM answers A WHERE author_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $authorId);
        $ps->execute();
        $id = $ps->fetch()->max;
        return $id;
    }

    public function vote_exists($memberId, $answerId)
    {
        $query = 'SELECT V.* FROM votes V WHERE V.answer_id=:id AND V.member_id=:memberid';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $answerId);
        $ps->bindValue(':memberid', $memberId);
        $ps->execute();
        $row = $ps->fetch();
        if (!empty($row)) {
            return new Vote($row->member_id, $row->answer_id, $row->liked);
        }
        return null;
    }

    public function delete_vote($memberId, $answerId)
    {
        $query = 'DELETE FROM votes WHERE answer_id=:id AND member_id=:memberid';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $answerId);
        $ps->bindValue(':memberid', $memberId);
        $ps->execute();
    }

    public function update_vote($memberId, $answerId, $liked)
    {
        $query = 'UPDATE votes SET liked=:liked WHERE answer_id=:id AND member_id=:memberid';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':liked', $liked);
        $ps->bindValue(':id', $answerId);
        $ps->bindValue(':memberid', $memberId);
        $ps->execute();
    }

    public function insert_vote($memberId, $answerId, $vote)
    {
        $query = "INSERT INTO votes  VALUES ($memberId,$answerId,$vote)";
        $ps = $this->_db->prepare($query);
        $ps->execute();
    }

    # Select the member corresponding to the 'id' parameter
    public function select_member($member_id)
    {
        $query = 'SELECT * FROM members WHERE member_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $member_id);
        $ps->execute();
        $row = $ps->fetch();
        $member = new Member($row->member_id, $row->login,$row->lastname, $row->firstname, $row->mail, $row->admin, $row->suspended);
        return $member;
    }

    # Select all members from the config
    public function select_all_members()
    {
        $query = 'SELECT * FROM members';
        $ps = $this->_db->prepare($query);
        $ps->execute();
        $members = array();
        while ($row = $ps->fetch()) {
            $members[] = new Member($row->member_id, $row->login, $row->lastname, $row->firstname, $row->mail, $row->admin, $row->suspended);
        }
        return $members;
    }

    # Changing the state of the member at suspended
    public function suspend_member($memberid)
    {
        $query = 'UPDATE members SET suspended=1 WHERE member_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $memberid);
        $ps->execute();
    }

    # Changing the state of the member at unsus
    public function unsuspend_member($memberid)
    {
        $query = 'UPDATE members SET suspended=0 WHERE member_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $memberid);
        $ps->execute();
    }

    # Upgrading member to admin
    public function upgrade_to_admin($memberid)
    {
        $query = 'UPDATE members SET admin=1 WHERE member_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $memberid);
        $ps->execute();
    }

    # Downgrading admin to basic member
    public function demote_admin($memberid)
    {
        $query = 'UPDATE members SET admin=0 WHERE member_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $memberid);
        $ps->execute();
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

    # Select the question and question's author corresponding to the 'id' parameter
    public function select_question($question_id)
    {
        $answers = $this->select_answers_authors_votes($question_id);
        $query = 'SELECT Q.*,M.*,A.* FROM questions Q, members M,answers A WHERE question_id=:id AND M.member_id=Q.author_id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $question_id);
        $ps->execute();
        $row = $ps->fetch();
        $member = new Member($row->member_id, $row->login, $row->lastname, $row->firstname, $row->mail, $row->admin, $row->suspended);
        $question = new Question($row->question_id, $member, $row->category_id, $row->best_answer_id, $row->title, $row->subject, $row->state, $row->publication_date, $answers);
        return $question;
    }

    # Update the question corresponding to the 'id' parameter
    public function edit_question($question_id, $title, $subject, $category)
    {
        $query = 'UPDATE questions SET title=:title,subject=:subject,category_id=:cat WHERE question_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':title', $title);
        $ps->bindValue(':subject', $subject);
        $ps->bindValue(':cat', $category);
        $ps->bindValue(':id', $question_id);
        $ps->execute();
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
        if (!empty($row)) {
            $member = new Member($row->member_id, $row->login, $row->lastname, $row->firstname, $row->mail, $row->admin, $row->suspended);
            if (!password_verify($password, $row->password)) {
                $member = null;
            }
        }
        return $member;
    }

    # Return true if the login in parameter exists in the config
    public function login_exists($login)
    {
        $query = 'SELECT * FROM members WHERE login=:login';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':login', $login);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    # Insert a new member in the config
    public function insert_member($lastname, $firstname, $mail, $login, $password)
    {
        $query = 'INSERT INTO members (lastname,firstname,mail,login,password,admin,suspended) VALUES (:lastname,:firstname,:mail,:login,:password,:admin,:suspended)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':lastname', $lastname);
        $ps->bindValue(':firstname', $firstname);
        $ps->bindValue(':mail', $mail);
        $ps->bindValue(':login', $login);
        $ps->bindValue(':password', $password);
        $ps->bindValue(':admin', 0);
        $ps->bindValue(':suspended', 0);
        $ps->execute();
    }

    # Verify if the category exists
    public function category_exists($idCategory)
    {
        $query = ' SELECT * FROM categories WHERE category_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $idCategory);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    # Verify if the question exists
    public function question_exists($idQuestion)
    {
        $query = ' SELECT * FROM questions WHERE question_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $idQuestion);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    # Select the newest questions + their respective author and category
    public function select_newest_questions_authors_categories()
    {
        $query = 'SELECT Q.*, M.*, C.* FROM questions Q, members M, categories C WHERE Q.author_id = M.member_id AND Q.category_id = C.category_id  AND Q.state is null ORDER BY Q.question_id DESC';
        $ps = $this->_db->prepare($query);
        $ps->execute();

        $questions = array();
        while ($row = $ps->fetch()) {
            $author = new Member($row->member_id, $row->login, $row->lastname, $row->firstname, $row->mail, $row->admin, $row->suspended);
            $category = new Category($row->category_id, $row->name);
            $questions[] = new Question($row->question_id, $author, $category, $row->best_answer_id, $row->title, $row->subject, $row->state, $row->publication_date ,null);
        }
        return $questions;
    }

    # Select all questions + their respective author from the category with the specified id
    public function select_questions_authors($idCategory)
    {
        $query = 'SELECT Q.*, M.* FROM questions Q, members M WHERE Q.author_id = M.member_id AND Q.category_id = :id ORDER BY Q.question_id DESC';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $idCategory);
        $ps->execute();

        $questions = array();

        while ($row = $ps->fetch()) {
            $author = new Member($row->member_id, $row->login, $row->lastname, $row->firstname, $row->mail, $row->admin, $row->suspended);
            $questions[] = new Question($row->question_id, $author, $row->category_id, $row->best_answer_id, $row->title, $row->subject, $row->state, $row->publication_date);
        }
        return $questions;
    }

    # Select member's questions + their categories
    public function select_member_questions_categories($memberId)
    {
        $query = 'SELECT Q.*, C.* FROM questions Q, categories C WHERE Q.author_id = :id AND Q.category_id = C.category_id ORDER BY Q.question_id DESC';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $memberId);
        $ps->execute();

        $questions = array();

        while ($row = $ps->fetch()) {
            $category = new Category($row->category_id, $row->name);
            $questions[] = new Question($row->question_id, $row->author_id, $category, $row->best_answer_id, $row->title, $row->subject, $row->state, $row->publication_date);
        }
        return $questions;
    }

    # Add the best answer at the question passed by parameters
    public function set_as_best_answer($questionId, $answerId)
    {
        $query = 'UPDATE questions SET best_answer_id=:answerid,state=\'solved\' WHERE question_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':answerid', $answerId);
        $ps->bindValue(':id', $questionId);
        $ps->execute();
    }

    public function delete_best_answer($questionId){
        $query = 'UPDATE questions SET best_answer_id=null,state=null WHERE question_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $questionId);
        $ps->execute();
    }

    # Select all questions + their respective author from the category with the specified id + votes
    public function select_answers_authors_votes($idQuestion)
    {
        $query = 'SELECT A.*, M.*  FROM answers A, members M   WHERE  A.author_id= M.member_id AND A.question_id = :id ORDER BY A.answer_id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $idQuestion);
        $ps->execute();
        $answers = array();
        $membersWhoLiked = array();
        $membersWhoDisliked = array();
        while ($row = $ps->fetch()) {
            $member = new Member($row->member_id, $row->login, $row->lastname, $row->firstname, $row->mail, $row->admin, $row->suspended);
            $answers[$row->answer_id] = new Answer($row->answer_id, $member, $row->question_id, $row->subject, $row->publication_date, 0, 0,$membersWhoLiked,$membersWhoDisliked);
        }

        $query = 'SELECT A.answer_id,V.member_id,count(V.liked) as \'likes\'  FROM answers A,votes V  WHERE A.question_id = :id AND V.answer_id=A.answer_id  AND V.liked=1  GROUP BY A.answer_id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $idQuestion);
        $ps->execute();
        while ($row = $ps->fetch()) {
            $answers[$row->answer_id]->setLikes($row->likes);
            $answers[$row->answer_id]->add_a_member_who_liked($row->member_id);
        }

        $query = 'SELECT A.answer_id,V.member_id,count(V.liked) as \'dislikes\'  FROM answers A,votes V WHERE A.question_id = :id AND V.answer_id=A.answer_id AND V.liked=0 GROUP BY A.answer_id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $idQuestion);
        $ps->execute();
        while ($row = $ps->fetch()) {
            $answers[$row->answer_id]->setDislikes($row->dislikes);
            $answers[$row->answer_id]->add_a_member_who_disliked($row->member_id);

        }
        $answersWithoutHoles = array();
        # Index 0 reserved for the best answer
        $answersWithoutHoles[0] = null;
        foreach ($answers as $i => $answer) {
            $answersWithoutHoles[] = $answer;
        }
        return $answersWithoutHoles;
    }

    # Select the questions that contains a certain keyword (+ their respective author and category)
    public function search_questions_authors_categories($keyword)
    {
        $keyword = strtolower($keyword);
        $query = 'SELECT Q.*, M.*, C.* FROM questions Q, members M, categories C WHERE Q.author_id = M.member_id AND Q.category_id = C.category_id AND (LOWER(Q.title) LIKE :keyword OR LOWER(Q.subject) LIKE :keyword) ORDER BY Q.question_id DESC';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':keyword', "%$keyword%");
        $ps->execute();

        $questions = array();

        while ($row = $ps->fetch()) {
            $author = new Member(null, $row->login, null, null, null, null, null);
            $category = new Category($row->category_id, $row->name);
            $questions[] = new Question($row->question_id, $author, $category, null, $row->title, null, null, $row->publication_date, null);
        }
        return $questions;
    }

    # Insert a new answer with the specified question_id
    public function insert_answer($author_id, $question_id, $subject, $publication_date)
    {
        $query = 'INSERT INTO answers (author_id,question_id,subject,publication_date) VALUES (:author_id,:question_id,:subject,:publication_date)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':author_id', $author_id);
        $ps->bindValue(':question_id', $question_id);
        $ps->bindValue(':subject', $subject);
        $ps->bindValue(':publication_date', $publication_date);
        $ps->execute();
    }

    # Insert a new question
    public function insert_question($author_id, $category_id, $title, $subject, $publication_date)
    {
        $query = 'INSERT INTO questions (author_id,category_id,title,subject,publication_date) VALUES (:author_id,:category_id,:title,:subject,:publication_date)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':author_id', $author_id);
        $ps->bindValue(':category_id', $category_id);
        $ps->bindValue(':title', $title);
        $ps->bindValue(':subject', $subject);
        $ps->bindValue(':publication_date', $publication_date);
        $ps->execute();
    }

    # Delete a question and all related questions
    public function delete_question($questionid)
    {
        $query = 'DELETE FROM questions WHERE question_id=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $questionid);
        $ps->execute();
    }

    # Set a question as duplicate
    public function duplicate_question($questionid)
    {
        $query = "UPDATE questions SET state='duplicated' WHERE question_id=:id";
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $questionid);
        $ps->execute();
    }

    # Set a question's state according to the state variable
    public function change_question_state($questionid,$state)
    {
        $query = "UPDATE questions SET state=:state WHERE question_id=:id";
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $questionid);
        $ps->bindValue(':state', $state);
        $ps->execute();
    }

    #Select the last posted question
    public function select_last_posted_question()
    {
        $query = 'SELECT MAX(question_id) as \'id\' FROM questions';
        $ps = $this->_db->prepare($query);
        $ps->execute();
        $row = $ps->fetch();
        return $row->id;
    }
}
