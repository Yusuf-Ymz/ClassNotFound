<?php

class Question
{
    private $_question_id;
    private $_author;
    private $_category;
    private $_best_answer_id;
    private $_title;
    private $_subject;
    private $_state;
    private $_publication_date;

    public function __construct($question_id, $author, $category, $best_answer_id, $title, $subject, $state, $publication_date)
    {
        $this->_question_id = $question_id;
        $this->_author = $author;
        $this->_category = $category;
        $this->_best_answer_id = $best_answer_id;
        $this->_title = $title;
        $this->_subject = $subject;
        $this->_state = $state;
        $this->_publication_date = $publication_date;
    }

    public function questionId()
    {
        return $this->_question_id;
    }

    public function author()
    {
        return $this->_author;
    }

    public function authorId()
    {
        return $this->_author;
    }

    public function category()
    {
        return $this->_category;
    }

    public function categoryId()
    {
        return $this->_category;
    }

    public function bestAnswerId()
    {
        return $this->_best_answer_id;
    }

    public function title()
    {
        return $this->_title;
    }

    public function html_title()
    {
        return htmlspecialchars($this->_title);
    }

    public function subject()
    {
        return $this->_subject;
    }

    public function html_subject()
    {
        return htmlspecialchars($this->_subject);
    }

    public function state()
    {
        return $this->_state;
    }

    public function publicationDate()
    {
        return $this->_publication_date;
    }

}