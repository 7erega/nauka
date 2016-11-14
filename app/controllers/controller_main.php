<?php

/**
 * Class Controller_Main
 * головна сторінка сайту (вхід/реєстрація)
 */

class Controller_Main extends Controller {

    function __construct() {
        $this->model = new Model_Main();
        $this->view = new View;
    }

    function action_index() {
        $this->view->generate('main_view.php', 'template_view.php');
    }

    function action_auth() {
        $this->model->get_data();
    }

    function action_reg() {
        $this->model->send_data();
    }

    function action_logout() {
        unset($_SESSION['logged_user']);
        header('Location: /');
    }
}