<?php

class HomepageController
{
    public function __construct() {

    }

    public function run(){


        require_once(VIEWS . 'homepage.php');
    }
}