<?php
    session_start();

    unset($_SESSION['logged_in']);
    unset($_SESSION['logged_in_user']);

    session_destroy();

    header('location: login.php');
?>