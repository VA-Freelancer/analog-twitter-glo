<?php
    include_once "includes/functions.php";
    $posts = get_liked_posts();
    $error = get_error_message();
    $title= "Понравившиеся твиты";
    include_once "includes/header.php";
    include_once "includes/posts.php";
    include_once "includes/footer.php";
