<?php

class Question
{
    private $_question_id;
    private $_author_id;
    private $_category_id;
    private $_best_answer_id;
    private $_title;
    private $_subject;
    private $_state;
    private $_date_publication;

    public function __construct($question_id,$author_id,$category_id,$title,$subject,$_date_publication)
    {
        $this->_question_id = $question_id;
        $this->_author_id = $author_id;
        $this->_category_id = $category_id;
        $this->_title = $title;
        $this->_subject = $subject;
        $this->_date_publication = $_date_publication;
    }


    public function getQuestionId()
    {
        return $this->_question_id;
    }


    public function getAuthorId()
    {
        return $this->_author_id;
    }

    public function getCategoryId()
    {
        return $this->_category_id;
    }


    public function getBestAnswerId()
    {
        return $this->_best_answer_id;
    }


    public function getTitle()
    {
        return $this->_title;
    }

    public function html_title(){
        return htmlspecialchars($this->_title);
    }

    public function getSubject()
    {
        return $this->_subject;
    }

    public function html_subject(){
        return htmlspecialchars($this->_subject);
    }

    public function getState()
    {
        return $this->_state;
    }


    public function html_state(){
        return htmlspecialchars($this->_state);
    }

    public function getDatePublication()
    {
        return $this->_date_publication;
    }
}