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
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Category($row->category_id, $row->name);
        }
        return $tableau;
    }

}