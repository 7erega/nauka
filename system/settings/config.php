<?php

    /**
     * Конфігураційний файл системи
     */

    define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT']); //визначаємо головну директорію
    session_start(); //запускаємо сесію

    //підключаємо додаткові конфігураційні файли і бібліотеки
    require_once ROOT_DIR.'/system/lib/db/rb.php'; //підключаємо RedBeanPHP
    require_once ROOT_DIR.'/system/settings/db_connect.php'; //файл для підключення до бази даних