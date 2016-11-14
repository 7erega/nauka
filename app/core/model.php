<?php

/**
 * Class Model
 * створюємо об`єкт для підключення до бази даних (system/settings/db_connect.php)
 */

class Model {

    public $db;

    function __construct() {
        $this->db = new DB_Connect();
    }

    public function get_data() {

    }

    public function send_data() {

    }

}