<?php
$_SESSION['last_uri'] = $_SERVER['REQUEST_URI'];
$_SESSION['last_uri2'] = $_SESSION['last_uri'];
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "hotel_complex");

ini_set("display_errors", 0);
error_reporting(0);