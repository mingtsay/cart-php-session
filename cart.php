<?php
include('include.inc.php');
$total = 0;
?>
<!DOCTYPE html>
<meta charset="utf-8"/>
<link rel="stylesheet" href="bootstrap.css"/>
<link rel="stylesheet" href="custom.min.css"/>
<title>購物車清單</title>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="./">購物車</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="切換導航列">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="products.php">商品列表</a>
                </li>
                <li class="nav-item active">
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
                <h1>購物車清單</h1>
                <p class="lead">檢視購物車內所有商品</p>
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">商品編號</th>
                <th scope="col">商品名稱</th>
                <th scope="col">商品價格</th>
                <th scope="col">購買數量</th>
                <th scope="col">價格小計</th>
                <th scope="col">購物車功能</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($_SESSION['cart'])): ?>
            <tr>
                <td colspan="5">您的購物車尚無任何商品，請至<a href="products.php">商品列表</a>挑選商品。</td>
            </tr>
        <?php else: ?>
        <?php   foreach ($_SESSION['cart'] as $product): ?>
            <?php $total += ($price = (int) $product['price'] * (int) $product['quantity']); ?>
            <tr>
                <td><?php echo($product['id']) ?></td>
                <td><?php echo($product['name']) ?></td>
                <td>NT$<?php echo(number_format($product['price'])) ?></td>
                <td><?php echo($product['quantity']) ?></td>
                <td>NT$<?php echo(number_format($price)) ?></td>
                <td>
                    <a href="edit.php?id=<?php echo($product['id']) ?>" class="btn btn-primary btn-sm">修改數量</a>
                    <a href="remove.php?id=<?php echo($product['id']) ?>" class="btn btn-danger btn-sm">移除</a>
                </td>
            </tr>
        <?php   endforeach ?>
        <?php endif ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right">
                    價格總計 NT$<?php echo(number_format($total)) ?>
                </td>
            </tr>
        </tfoot>
    </table>
    <footer id="footer">
        <div class="row">
            <div class="col-lg-12">
                <p>&copy; 2019 Ming Tsay.</p>
            </div>
        </div>
    </footer>
</div>
