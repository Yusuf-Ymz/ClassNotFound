<?php

class RegisterController
{

    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {

        # User already connected
        if (isset($_SESSION['logged'])) {
            header('Location: index.php?action=homepage');
            die();
        }

        # Attempting to register...

        # Display notification if any of the fields are empty
        if (!empty($_POST)) {
            if (preg_match('/^\s*$/', $_POST['lastname']) || preg_match('/^\s*$/', $_POST['firstname']) || preg_match('/^\s*$/', $_POST['lastname']) || preg_match('/^\s*$/', $_POST['login']) || empty($_POST['password'])) {
                $notification = 'Please fill in all fields';
            } else {
                # All fields are completed, verification...

                # Invalid e-mail address
                if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $_POST['mail'])) {
                    $notification = 'Please enter a valid mail address';
                } # Successfully registered
                else {
                    # Catch error if login already exists
                    try {
                        # Register member to the database
                        $this->_db->insert_member($_POST['lastname'], $_POST['firstname'], $_POST['mail'], $_POST['login'], password_hash($_POST['password'], PASSWORD_BCRYPT));
                        # Redirection to login after being successfully registered
                        header('Location: index.php?action=login');
                        die();
                    } catch (PDOException $e) {
                        $notification = 'This username already exists';
                    }
                }
            }
        }
        require_once(VIEWS . 'register.php');
    }
}