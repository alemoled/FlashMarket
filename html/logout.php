<?php

    session_start();
    session_destroy();

    header('location:main.php');

    exit;
?>