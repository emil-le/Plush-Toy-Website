<?php
session_start();
    require_once __DIR__."/../autoload/autoload.php";
    if (isset($_SESSION['users']) ) {
        unset($_SESSION['users']);
    }

    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }

rdr_url('index.php');

