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
        if (!empty($_POST)) {
            # Suspend a member's account
            if (isset($_POST['Suspend'])) {
                foreach ($_POST['Suspend'] as $no => $i) {
                    $this->_db->suspend_member($no);
                }
            } # Activate a member's account
            else if (isset($_POST['Activate'])) {
                foreach ($_POST['Activate'] as $no => $id) {
                    $this->_db->unsuspend_member($no);
                }
            } # Upgrade a member to admin grade
            else if (isset($_POST['upgrade'])) {
                foreach ($_POST['upgrade'] as $no => $id) {
                    $this->_db->upgrade_to_admin($no);
                }
            } # Demote an admin to basic member
            else {
                foreach ($_POST['demote'] as $no => $id) {
                    $this->_db->demote_admin($no);
                }
            }
        }
        # Selecting all members to display
        $members = $this->_db->select_all_members();

        require_once(VIEWS . 'admin.php');
    }
}