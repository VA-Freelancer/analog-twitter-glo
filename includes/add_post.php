<?php
    include_once "functions.php";
    if(!logged_in()) redirect_page();
    if(isset($_POST['text']) && !empty($_POST['text']) && isset($_POST['image'])) {
        if(!add_post($_POST['text'], $_POST['image'])){
            $_SESSION['error'] = 'ВО время добавления поста что-то пошло не так';
        }
    }
    redirect_page('user-posts');