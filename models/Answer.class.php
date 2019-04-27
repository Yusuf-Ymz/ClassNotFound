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
    private $_members_who_liked;
    private $_members_who_disliked;

    public function __construct($answer_id, $member, $question_id, $subject, $publication_date,$likes,$dislikes,$members_who_liked,$members_who_disliked)
    {
        $this->_answer_id = $answer_id;
        $this->_member = $member;
        $this->_question_id = $question_id;
        $this->_subject = $subject;
        $this->_publication_date = $publication_date;
        $this->_likes = $likes;
        $this->_dislikes = $dislikes;
        $this->_members_who_liked = $members_who_liked;
        $this->_members_who_disliked = $members_who_disliked;
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

    public function check_member_liked($memberId){
        return array_key_exists($memberId,$this->_members_who_liked);
    }

    public function check_member_disliked($memberId){
        return array_key_exists($memberId,$this->_members_who_disliked);
    }

    public function add_a_member_who_liked($memberId){
        $this->_members_who_liked[$memberId]=$memberId;
    }

    public function add_a_member_who_disliked($memberId){
        $this->_members_who_disliked[$memberId]=$memberId;
    }

    public function setLikes($likes){
        $this->_likes=$likes;
    }

    public function setDislikes($dislikes){
        $this->_dislikes=$dislikes;
    }
}