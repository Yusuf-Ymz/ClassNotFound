<?php

class Member
{
    private $_member_id;
    private $_login;
    private $_lastName;
    private $_firstName;
    private $_mail;
    private $_admin;
    private $_suspended;

    public function __construct($memberid,$login,$lastName,$firstName,$mail,$admin,$suspended)
    {
        $this->_member_id=$memberid;
        $this->_login=$login;
        $this->_lastName=$lastName;
        $this->_firstName=$firstName;
        $this->_mail=$mail;
        $this->_admin=$admin;
        $this->_suspended=$suspended;
    }


    public function getMemberId()
    {
        return $this->_member_id;
    }


    public function getLogin()
    {
        return $this->_login;
    }

    public function html_login(){
        return htmlspecialchars($this->_login);
    }

    public function getLastName()
    {
        return $this->_lastname;
    }

    public function html_lastName(){
        return htmlspecialchars($this->_lastname);
    }

    public function getFirstName()
    {
        return $this->_firstName;
    }

    public function html_firstName(){
        return htmlspecialchars($this->_firstName);
    }

    public function getMail()
    {
        return $this->_mail;
    }

    public function html_mail(){
        return htmlspecialchars($this->_mail);
    }

    public function getAdmin()
    {
        return $this->_admin;
    }


    public function getSuspended()
    {
        return $this->_suspended;
    }
}