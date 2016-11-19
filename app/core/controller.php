<?php

/**
 * Class Controller
 * створюємо об`єкт для формування виду сторінки
 */

class Controller {

    public $model;
    public $view;
    public $controller;

    function __construct() {
        $this->view = new View();
    }
}