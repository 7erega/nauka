<?php

    /**
     * Class DB_Connect
     * підключення до бази даних
     */

    class DB_Connect {
        public function connect() {
            R::setup('mysql:host=localhost;dbname=nauka', 'root', '');
        }
    }