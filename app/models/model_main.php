<?php

/**
 * Class Model_Main
 * робота з базою даних (вхід/реєстрація)
 */

class Model_Main extends Model {

    private $json = array('errors' => array(), 'user_role' => array());

    public function get_data() { //отримання даних з бази (авторизація)

        $this->db->connect(); //підключаємось до бд

        $data = $_POST;

        if(isset($data['login'])) { //якщо натиснутий submit з таким іменем

            $user = R::findOne('users', 'user_email = ?', array($data['user_email'])); //перевіряємо наявність email в бд

            if($user) { //якщо такий користувач існує
                if(md5(md5($data['user_password'])) == $user->user_password) { //і паролі збігаються
                    $this->set_session($user);
                } else {
                    $this->json['errors'][] = 'Ви ввели неправильний пароль!';
                }
            } else {
                $this->json['errors'][] = 'Користувач не знайдений!';
            }

            if(!empty($this->json['errors'])) { //якщо є помилки відсилаємо в браузер
                header('Content-Type: application/json');
                echo json_encode($this->json);
            }
        }
    }

    public function send_data() { //відправка даних в базу (реєстрація)

        $this->db->connect(); //підключаємось до бд

        $data = $_POST;

        if(isset($data['signup'])) { //якщо натиснутий submit з таким іменем

            if(trim($data['user_full_name']) == '') {
                $this->json['errors'][] = 'Введіть ПІБ!';
            }

            if(trim($data['user_email']) == '') {
                $this->json['errors'][] = 'Введіть Email!';
            }

            if($data['user_password'] == '') {
                $this->json['errors'][] = 'Введіть пароль!';
            }

            if(R::count('users', "user_email = ?", array($data['user_email'])) > 0) {
                $this->json['errors'][] = "Такий Email вже використовується!";
            }

            if(empty($this->json['errors'])) { //якщо немає помилок
                $user = R::dispense('users'); //створюємо таблицю в бд
                $user->user_full_name = trim($data['user_full_name']); //додаємо поля
                $user->user_email = trim($data['user_email']);
                $user->user_password = md5(md5($data['user_password']));
                $user->user_role = $data['user_role'];
                R::store($user);

                $this->set_session($user);
            } else { //якщо є помилки відправляємо їх в браузер
                header('Content-Type: application/json');
                echo json_encode($this->json);
            }
        }
    }

    public function find_user($value) {
        $this->db->connect();
        return R::findOne('users', 'id = ?', array($value));
    }

    private function set_session($user) {
        $_SESSION['logged_user'] = $user->id; //створюємо комірку в сесії
        $user_role_headers = $this->user_role($user->user_role); //перенаправляємо на відповідну сторінку
        $this->auth_headers($user_role_headers);
    }

    public function user_role($value = '') { //перенаправлення користувача в залежності від ролі
        switch($value) {
            case 'teach':
                $this->json['user_role'][0] = '/teach/index';
                break;
            case 'resp_person':
                $this->json['user_role'][0] = '/resp_person/index';
                break;
            case 'head_depart':
                $this->json['user_role'][0] = 'head_depart/index';
                break;
            case 'resp_person_depart':
                $this->json['user_role'][0] = '/resp_person_depart/index';
                break;
            case 'direct_inst':
                $this->json['user_role'][0] = '/direct_inst/index';
                break;
            case 'resp_person_science':
                $this->json['user_role'][0] = '/resp_person_science/index';
                break;
            case 'pro_rector_science':
                $this->json['user_role'][0] = '/pro_rector_science/index';
                break;
            default: $this->json['user_role'][0] = '/main/index';
        }

        return $this->json;
    }

    private function auth_headers($value) {
        header('Content-Type: application/json');
        echo json_encode($value);
        exit();
    }

    public function home_headers($value) {
        header('Location: http://'.$_SERVER["HTTP_HOST"].$value["user_role"][0].'');
        exit();
    }
}