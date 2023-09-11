<?php

session_start();

$_GET['action'] = !empty($_GET['action']) ? $_GET['action'] : 0;

include './utils/constants.php';
include './config/databaseConfig.php';

// $_SESSION['userId'] = !empty($_SESSION['userId']) ? $_SESSION['userId'] : "not";


if (!isset($_SESSION['userId'])) {
    $_GET['p'] = 'login';
    include './layout/loginLayout.php';
} elseif ($_SESSION['userId'] == 0) {
    include './layout/dashBoradLayout.php';
} else {
    include './layout/dashBoradLayout.php';
}