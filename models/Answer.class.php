<?php

class Answer
{
    private $_answer_id;
    private $_member;
    private $_question_id;
    private $_subject;
    private $_publication_date;
    private $_likes;
    private $_dislikes;

    public function __construct($answer_id, $member, $question_id, $subject, $publication_date,$likes,$dislikes)
    {
        $this->_answer_id = $answer_id;
        $this->_member = $member;
        $this->_question_id = $question_id;
        $this->_subject = $subject;
        $this->_publication_date = $publication_date;
        $this->_likes=$likes;
        $this->_dislikes=$dislikes;
    }

    public function answerId()
    {
        return $this->_answer_id;
    }

    public function member()
    {
        return $this->_member;
    }

    public function questionId()
    {
        return $this->_question_id;
    }

    public function subject()
    {
        return $this->_subject;
    }

    public function html_subject()
    {
        return htmlspecialchars($this->_subject);
    }

    public function publicationDate()
    {
        return $this->_publication_date;
    }

    public function likes(){
        return $this->_likes;
    }

    public function dislikes(){
        return $this->_dislikes;
    }

    public function setLikes($likes){
        $this->_likes=$likes;
    }

    public function setDislikes($dislikes){
        $this->_dislikes=$dislikes;
    }
}