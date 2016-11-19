<?php

class Model_Teach extends Model {

    private $logged_user;

    function get_data() {
        $this->db->connect();
        $this->logged_user = R::findOne('users', 'id = ?', array($_SESSION['logged_user']));
        return $this->logged_user;
    }

    function send_data() {

    }
}