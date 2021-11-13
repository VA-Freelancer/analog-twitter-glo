<?php
    include_once 'config.php';

/**
 * @param $var
 * @param bool $stop
 * @return string
 */

    function debug($var, bool $stop): string
    {
        echo "<pre>";
            print_r($var);
        echo "</pre>";

        if($stop) die;

        return false;
    }

    function get_url(string $page = ''): string
    {
        return HOST . "/$page";
    }
    function redirect_page($page = ''){
        header("Location: " . get_url("$page"));

    }
    function get_page_title($title = ''): string
    {
        if(!empty($title)){
            return SITE_NAME . " - $title";
        }else{
            return SITE_NAME;
        }
    }
    function db(){
        try{
            return new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USER, DB_PASS,
            [
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function db_query($sql, $exec = false) {
        if(empty($sql)) return false;
        if($exec) return db()->exec($sql);

        return db()->query($sql);
    }
    function get_posts($user_id = 0){
        if ($user_id>0) return db_query( "SELECT posts.*, users.name, users.login, users.avatar FROM `posts` JOIN `users` ON users.id = posts.user_id WHERE posts.user_id = $user_id")->fetchAll();
        return db_query("SELECT posts.*, users.name, users.login, users.avatar FROM `posts` JOIN `users` ON users.id = posts.user_id;")->fetchAll();
    }
    function get_user_info($login){
        return db_query( "SELECT * FROM `users` WHERE `login` = '$login';")->fetch();

    }

    function add_user($login, $pass){
        $login = trim($login);
        $name = ucfirst($login);
        $password = password_hash($pass, PASSWORD_DEFAULT);
        return db_query( "INSERT INTO `users` (`id`, `login`, `pass`, `name`) VALUES (NULL, '$login', '$password', '$name');", true);
    }
    function register_user($auth_data){
        if(empty($auth_data) ||
            !isset($auth_data['login']) || empty($auth_data['login']) ||
            !isset($auth_data['pass']) || empty($auth_data['pass']) ||
            !isset($auth_data['pass2']) || empty($auth_data['pass2'])) return false;
        $user = get_user_info($auth_data['login']);
        if(!empty($user)) {
            $_SESSION['error'] = 'Пользователь ' . $auth_data['login'] . ' уже существует';
            redirect_page('register.php');
            die;
        }
        if($auth_data['pass'] !== $auth_data['pass2']) {
            $_SESSION['error'] = 'Пароли не совпадают';
            redirect_page('register.php');
            die;
        }
        if(add_user($auth_data['login'], $auth_data['pass'])){
            $_SESSION['success'] = 'Регистрация прошла успешно!';
            redirect_page();

        }
    }
    function login($auth_data){
        if(empty($auth_data) ||
            !isset($auth_data['login']) || empty($auth_data['login'] ) ||
            !isset($auth_data['pass']) || empty($auth_data['pass'] )) return false;
        $user = get_user_info($auth_data['login']);
        if(empty($user)){
            $_SESSION['error'] = "Логин или пароль не найдены";
            redirect_page();
            die;
        }
        if(password_verify($auth_data['pass'], $user['pass'])){
            $_SESSION['user'] = $user;
            $_SESSION['error'] = '';

            redirect_page('user-posts.php?id=' .  $_SESSION['user']['id']);
            die;
        }else{
            $_SESSION['error'] = 'Пароль не верный';
            redirect_page();
        }
        die;
    }
    function  get_error_message(){
        $error = '';
        if(isset($_SESSION['error']) || empty($_SESSION['error'])){
            $error = $_SESSION['error'];
            $_SESSION['error'] = '';
        }
        return $error;
    }