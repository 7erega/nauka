<?php

/**
 * Class Controller_Main
 * головна сторінка сайту (вхід/реєстрація)
 */

class Controller_Main extends Controller {

    public $find_user;

    function __construct() {
        $this->model = new Model_Main();
        $this->view = new View;
    }

    function action_index() {
        if(isset($_SESSION['logged_user'])) {
            $this->find_user = $this->model->find_user($_SESSION['logged_user']);
            $user_role_headers = $this->model->user_role($this->find_user->user_role);
            $this->model->home_headers($user_role_headers);
        } else
            $this->view->generate('main_view.php', 'template_view.php');
    }

    function action_auth() {
        $this->model->get_data();
    }

    function action_reg() {
        $this->model->send_data();
    }

    function action_logout() {
        session_destroy();
        header('Location: http://'.$_SERVER["HTTP_HOST"].'/');
    }
}