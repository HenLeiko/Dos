<?php
session_start(); 
$limit_request = 10;
if (!isset($_SESSION['first_request'])) {

    $_SESSION['requests'] = 0;
    $_SESSION['first_request'] = $_SERVER['REQUEST_TIME'];
}
$_SESSION['requests']++;

$interval = $_SERVER['REQUEST_TIME'] - $_SESSION['first_request'];

if ($interval <= 1 and $_SESSION['requests'] >= $limit_request) {
    $_SESSION['block'] = 1;
}

else if ($interval > 2) {
    $_SESSION['requests'] = 0;
    $_SESSION['banip'] = 0;
    $_SESSION['first_request'] = $_SERVER['REQUEST_TIME'];
}

if ($_SESSION['banip'] == 1) {
    header('HTTP/1.1 503 Service Unavailable');
    die;
}
