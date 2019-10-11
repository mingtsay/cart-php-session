<?php
include('include.inc.php');

// 讀取網址列上的 add.php?id=123 數字 
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

unset($_SESSION['cart']["$id"]);

header('location: cart.php');
