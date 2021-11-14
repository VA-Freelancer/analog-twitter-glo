<?php
    include_once "includes/functions.php";
    $posts = get_posts(0, true);
    $title= "C начала старые посты";
    include_once "includes/header.php";
    include_once "includes/posts.php";
    include_once "includes/footer.php";
