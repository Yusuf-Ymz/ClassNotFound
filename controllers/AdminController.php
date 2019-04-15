<?php

class AdminController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {
        # If the user is not connected or is not an admin --> homepage
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?action=homepage');
        }

        # If an admin clicked on a button
        var_dump($_POST);
        if (!empty($_POST)) {
            # Suspend a member's account
            if (isset($_POST['suspend'])) {
                $this->_db->suspend_member($_POST['member_id']);
            } # Activate a member's account
            else if (isset($_POST['activate'])) {
                $this->_db->unsuspend_member($_POST['member_id']);
            } # Upgrade a member to admin grade
            else if (isset($_POST['upgrade'])) {
                $this->_db->upgrade_to_admin($_POST['member_id']);
            } # Demote an admin to basic member
            else {
                $this->_db->demote_admin($_POST['member_id']);
            }
        }
        # Selecting all members to display
        $members = $this->_db->select_all_members();

        require_once(VIEWS . 'admin.php');
    }
}