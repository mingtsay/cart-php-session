<?php
include('config.inc.php');

session_start();

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

$db = new PDO(
    'mysql:host=' . DATABASE_HOSTNAME .
    ';dbname=' . DATABASE_DATABASE,
    DATABASE_USERNAME,
    DATABASE_PASSWORD,
    [PDO::MYSQL_ATTR_INIT_COMMAND]
);
$db->exec('SET NAMES UTF8MB4');
