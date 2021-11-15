<?php
    include_once "functions.php";

    if(!logged_in()) redirect_page();

//    debug($_GET, true);
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        if(!add_like($_GET['id'])){
            $_SESSION['error'] = 'ВО время добавления лайка что-то пошло не так';
        }
    }
    redirect_page();