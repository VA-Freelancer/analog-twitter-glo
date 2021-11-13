<?php
    include_once 'functions.php';

    session_destroy();

    redirect_page();
    die;