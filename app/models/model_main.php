<?php

/**
 * Class Model_Main
 * робота з базою даних (вхід/реєстрація)
 */

class Model_Main extends Model {

    public function get_data() { //отримання даних з бази

        session_start();

        $this->db->connect(); //підключаємось до бд

        $data = $_POST;

        if(isset($data['login'])) {
            $errors = array();

            $user = R::findOne('users', 'user_email = ?', array($data['user_email']));

            if($user) {
                if(md5(md5($data['user_password'])) == $user->user_password) {
                    $_SESSION['logged_user'] = $user;
                    $this->user_role($user->user_role);
                } else {
                    $errors[] = 'Ви ввели неправильний пароль!';
                }
            } else {
                $errors[] = 'Користувач не знайдений!';
            }

            if(!empty($errors)) {
                header('Content-Type: application/json');
                echo json_encode(array_shift($errors));
            }
        }
    }

    public function send_data() { //відправка даних в базу

        $this->db->connect(); //підключаємось до бд

        $data = $_POST;

        if(isset($data['signup'])) {
            $errors = array();

            if(trim($data['user_full_name']) == '') {
                $errors[] = 'Введіть ПІБ!';
            }

            if(trim($data['user_email']) == '') {
                $errors[] = 'Введіть Email!';
            }

            if($data['user_password'] == '') {
                $errors[] = 'Введіть пароль!';
            }

            if(R::count('users', "user_email = ?", array($data['user_email'])) > 0) {
                $errors[] = "Такий Email вже використовується!";
            }

            if(empty($errors)) {
                $user = R::dispense('users');
                $user->user_full_name = trim($data['user_full_name']);
                $user->user_email = trim($data['user_email']);
                $user->user_password = md5(md5($data['user_password'])); //password_hash($data['password'], PASSWORD_DEFAULT);
                $user->user_role = $data['user_role'];
                R::store($user);

                $this->user_role($data['user_role']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(array_shift($errors));
            }
        }
    }

    private function user_role($value = '') {
        switch($value) {
            case 'teach':
                $redirect_url = '/teach/index';
                break;
            case 'resp_person':
                $redirect_url = '/resp_person/index';
                break;
            case 'head_depart':
                $redirect_url = 'head_depart/index';
                break;
            case 'resp_person_depart':
                $redirect_url = '/resp_person_depart/index';
                break;
            case 'direct_inst':
                $redirect_url = '/direct_inst/index';
                break;
            case 'resp_person_science':
                $redirect_url = '/resp_person_science/index';
                break;
            case 'pro_rector_science':
                $redirect_url = '/pro_rector_science/index';
                break;
            default: $redirect_url = '/main/index';
        }

        header('Content-Type: application/json');
        echo json_encode($redirect_url);
        exit();
    }
}