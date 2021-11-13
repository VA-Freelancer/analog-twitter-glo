<?php
include_once "includes/functions.php";
    if(!isset($_SESSION['user']['id'])):
        if(!isset($_GET['id']) || empty($_GET['id'])) header("Location: " . get_url());
    endif;

    if (isset($_GET['id']) && !empty($_GET['id'])){
            $id = $_GET['id'];
    }else if(isset($_SESSION['user']['id'])){
        $id = $_SESSION['user']['id'];
    } else{
        $id = 0;
//        redirect_page();
    }

    $posts = get_posts($id);
    $title = 'Выводяться все твиты';
    if(!empty($posts) ){
        $title = 'Твиты пользователя @' . $posts[0]['login'];
    }
    $error = get_error_message();
    include_once "includes/header.php";
    include_once "includes/posts.php";
    include_once "includes/footer.php";
