<?php

class Controller_Teach extends Controller {

    public $logged_user;

    function __construct() {
        Route::loggedUser();
        $this->model = new Model_Teach();
        $this->view = new View();
    }

    function action_index() {
        $this->logged_user = $this->model->get_data();
        $this->view->generate('teach_view.php', 'template_view.php', $this->logged_user);
    }
}