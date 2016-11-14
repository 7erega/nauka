<?php

    /**
     * Підключаємо основні файли для роботи системи
     */

    require_once dirname(dirname(__FILE__)).'/system/settings/config.php'; //конфігураційний файл
    require_once ROOT_DIR.'/app/core/controller.php';
	require_once ROOT_DIR.'/app/core/model.php';
	require_once ROOT_DIR.'/app/core/view.php';
	require_once ROOT_DIR.'/app/core/route.php'; //файл зі статичним методом start

	Route::start(); //запускаємо маршрутизатор