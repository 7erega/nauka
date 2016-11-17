<?php

/**
 * Class Route
 * реалізація маршрутизації
 */

class Route {
    static function start() {
        //контролер та дія за замовчуванням
        $controller_name = 'Main';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']); //отримуємо шлях і розбиваємо по символу

        //отримуємо ім`я контролера
        if(!empty($routes[1])) {
            $controller_name = ucfirst($routes[1]);
        }

        //оримуємо ім`я екшена
        if(!empty($routes[2])) {
            $action_name = $routes[2];
        }

        //додаємо префікси
        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;

        //підключаємо файл з класом моделі
        $model_file = strtolower($model_name).".php";
        $model_path = "app/models/".$model_file;

        if(file_exists($model_path)) {
            include $model_path;
        }

        //підключаємо файл з класом контролера
        $controller_file = strtolower($controller_name).".php";
        $controller_path = "app/controllers/".$controller_file;

        if(file_exists($controller_path)) {
            include $controller_path;

            $controller = new $controller_name;
            $action = $action_name;

            if(method_exists($controller, $action)) {
                $controller->$action();
            }
        } else {
            Route::ErrorPage404();
        }
    }

    function ErrorPage404() {
        echo 'Error';
    }
}