<?php

/**
 * Class Controller
 * створюємо об`єкт для формування виду сторінки
 */

class Controller {

    public $model;
    public $view;

    function __construct() {
        $this->view = new View();
    }
}