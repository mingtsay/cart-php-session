<?php
include('include.inc.php');

// 讀取網址列上的 add.php?id=123 數字 
$id = isset($_GET['id']) ? $_GET['id'] : 0;

$product_query = $db->prepare('SELECT `id`, `name`, `price`, `stock` FROM `products` WHERE `id` = :id');
$product_query->bindValue(':id', $id);
$product_query->execute();

$product = $product_query->fetch();

// 確認是否有該商品存在於資料庫中
if ($product !== false) {
    if (isset($_SESSION['cart'][$product['id']])) {
        ++$_SESSION['cart'][$product['id']]['quantity'];
    } else {
        $_SESSION['cart'][$product['id']] = $product;
        $_SESSION['cart'][$product['id']]['quantity'] = 1;
    }
}

header('location: cart.php');
