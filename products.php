<?php
include('include.inc.php');

$products_query = $db->prepare('SELECT `id`, `name`, `price`, `stock` FROM `products`');
$products_query->execute();

$products = $products_query->fetchAll();
?>
<!DOCTYPE html>
<meta charset="utf-8"/>
<link rel="stylesheet" href="bootstrap.css"/>
<link rel="stylesheet" href="custom.min.css"/>
<style>
body { padding-top:120px }
</style>
<title>商品列表</title>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="./">購物車</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="切換導航列">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="products.php">商品列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        購物車清單
                    <?php if (!empty($_SESSION['cart'])): ?>
                        <span class="badge badge-pill badge-info"><?php echo(count($_SESSION['cart'])) ?></span>
                    <?php endif ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h1>商品列表</h1>
                <p class="lead">檢視所有商品</p>
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">商品編號</th>
                <th scope="col">商品名稱</th>
                <th scope="col">商品價格</th>
                <!--<th scope="col">庫存數量</th>-->
                <th scope="col">加入購物車</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo($product['id']) ?></td>
                <td><?php echo($product['name']) ?></td>
                <td>NT$<?php echo(number_format($product['price'])) ?></td>
                <!--<td><?php echo($product['stock']) ?></td>-->
                <td>
                <?php if (isset($_SESSION['cart'][$product['id']])): ?>
                    已加入購物車
                <?php else: ?>
                    <a href="add.php?id=<?php echo($product['id']) ?>" class="btn btn-primary btn-sm">加入購物車</a>
                <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <footer id="footer">
        <div class="row">
            <div class="col-lg-12">
                <p>&copy; 2019 Ming Tsay.</p>
            </div>
        </div>
    </footer>
</div>
