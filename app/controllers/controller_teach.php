<?php

class Controller_Teach extends Controller {

    function __construct() {
        $this->model = new Model();
        $this->view = new View();
    }

    function action_index() {
        $this->view->generate('teach_view.php', 'template_view.php');
    }
}