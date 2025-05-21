<?php
//error_reporting(0);
ob_start();
session_start();


//DEFINE("BASE_URL","http://cipetbhopal.com/");
DEFINE("BASE_URL","https://closer.cm/");

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PSWD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'closer_onigc_syges');

date_default_timezone_set('Africa/Douala');

$conn = new mysqli(DB_HOST, DB_USER, DB_PSWD, DB_NAME);
if ($conn->connect_error)
    die("Failed to connect database " . $conn->connect_error);
