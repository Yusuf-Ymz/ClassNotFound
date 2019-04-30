<?php

class Answer
{
    private $_answer_id;
    private $_author;
    private $_subject;
    private $_publication_date;
    private $_nbLikes;
    private $_nbDislikes;
    private $_like_ids;
    private $_dislike_ids;

    public function __construct($answer_id, $author, $subject, $publication_date, $nbLikes, $nbDislikes, $like_ids, $dislike_ids)
    {
        $this->_answer_id = $answer_id;
        $this->_author = $author;
        $this->_subject = $subject;
        $this->_publication_date = $publication_date;
        $this->_nbLikes = $nbLikes;
        $this->_nbDislikes = $nbDislikes;
        $this->_like_ids = $like_ids;
        $this->_dislike_ids = $dislike_ids;
    }

    public function answerId()
    {
        return $this->_answer_id;
    }

    public function author()
    {
        return $this->_author;
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

    public function nbLikes(){
        return $this->_nbLikes;
    }

    public function nbDislikes(){
        return $this->_nbDislikes;
    }

    public function check_member_liked($memberId){
        return array_key_exists($memberId, $this->_like_ids);
    }

    public function check_member_disliked($memberId){
        return array_key_exists($memberId, $this->_dislike_ids);
    }

    public function add_like_id($memberId){
        $this->_like_ids[$memberId] = $memberId;
    }

    public function add_dislike_id($memberId){
        $this->_dislike_ids[$memberId] = $memberId;
    }

    public function setLikes($nbLikes){
        $this->_nbLikes = $nbLikes;
    }

    public function setDislikes($nbDislikes){
        $this->_nbDislikes = $nbDislikes;
    }
}