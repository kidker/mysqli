<?php
    session_start();

    $mysqli = new mysqli("localhost", "root", "", "ornamentation");
    if ($mysqli->connect_errno) {
        echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    include 'classResult.php';//Подключаем мой класс

    function sanitize($data){
        return mysql_real_escape_string($data);
    }
    function user_exist($login, $mysqli){
        $login = sanitize($login);

        $result = new Result(
            $mysqli,
            array('s', $login),
            array('count'),
            "SELECT COUNT(`id`) FROM `users` WHERE `login` = ?"
        );
        $field = $result->getResult();
        return $field[0]['count'] == 1? true : false;

    }
    function user_register($login, $email, $name, $pass, $mysqli){
        $login = sanitize($login);
        $email = sanitize($email);
        $name = sanitize($name);
        $pass = md5(sanitize($pass));

        new Result(
            $mysqli,
            array('ssss', $login, $email, $name, $pass),
            array(''),
            "INSERT INTO `users` (`login`, `email`, `name`, `password`) VALUES (?, ?, ?, ?)"
        );
        return true;

    }
    function user_id_from_login($login, $mysqli){
        $result = new Result(
            $mysqli,
            array('s', $login),
            array('id'),
            "SELECT `id` FROM `users` WHERE `login` = ?"
        );
        $field = $result->getResult();

        return isset($field[0]['id'])? $field[0]['id'] : false;

    }
    function login($login, $pass, $mysqli){
        $id = user_id_from_login(sanitize($login), $mysqli);
        $login = sanitize($login);
        $pass = md5(sanitize($pass));

        $result = new Result(
            $mysqli,
            array('ss', $login, $pass),
            array('count'),
            "SELECT COUNT(`id`) FROM `users` WHERE `login` = ? AND `password` = ?"
        );
        $field = $result->getResult();

        return $field[0]['count'] == 1? $id : false;
    }

?>