<?php


class Vote
{
    private $_member_id;
    private $_answer_id;
    private $_liked;

    public function __construct($member_id,$answer_id, $liked)
    {
        $this->_member_id = $member_id;
        $this->_answer_id = $answer_id;
        $this->_liked = $liked;
    }

    public function memberId(){
        return $this->_member_id;
    }

    public function answerId(){
        return $this->_answer_id;
    }

    public function liked(){
        return $this->_liked;
    }
}