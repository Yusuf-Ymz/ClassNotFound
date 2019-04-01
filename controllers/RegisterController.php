<?php

class RegisterController
{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run(){

        # User already connected
        if(isset($_SESSION['logged'])){
            header('Location: index.php?action=homepage');
            die();
        }

        # Attempting to register...

        # Display notification if any of the fields are empty
        if(!empty($_POST)) {
            if(empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['mail']) || empty($_POST['login']) || empty($_POST['password'])) {
                $notification = 'Please fill in all fields';
            } else {
                # All fields are completed, verification...

                # Login already exists
                if($this->_db->login_exists($_POST['login']))
                {
                    $notification = 'This username already exists';
                }
                # Invalid e-mail address
                elseif(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $_POST['mail'])) {
                    $notification = 'Please enter a valid mail address';
                }

                # Successfully registered
                else {

                    # Register member to the database
                    $this->_db->insert_member($_POST['lastname'], $_POST['firstname'], $_POST['mail'], $_POST['login'], password_hash($_POST['password'], PASSWORD_BCRYPT));

                    # Redirection to homepage after being successfully registered
                    header('Location: index.php?action=login');
                    die();
                }
            }
        }

        require_once(VIEWS . 'register.php');
    }
}