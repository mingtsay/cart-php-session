<?php
include('include.inc.php');

$ids = isset($_POST['id']) ? $_POST['id'] : [];
$quantities = isset($_POST['quantity']) ? $_POST['quantity'] : [];

$product_query = $db->prepare('SELECT `id`, `name`, `price`, `stock` FROM `products` WHERE `id` = :id');

$products = [];
foreach ($ids as $index => $id) {
    $product_query->execute([':id' => $id]);
    $product = $product_query->fetch();
    $products[$id] = $product;
    $products[$id]['quantity'] = $quantities[$index];
}

$total = 0;
?>
<!DOCTYPE html>
<meta charset="utf-8"/>
<link rel="stylesheet" href="bootstrap.css"/>
<link rel="stylesheet" href="custom.min.css"/>
<title>結帳清單</title>
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
                <h1>結帳清單</h1>
                <p class="lead">檢視結帳明細</p>
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
            </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <?php $total += ($price = (int) $product['price'] * (int) $product['quantity']); ?>
            <tr>
                <td>
                    <?php echo($product['id']) ?>
                    <input type="hidden" name="id[]" value="<?php echo($product['id']) ?>"/>
                </td>
                <td><?php echo($product['name']) ?></td>
                <td>NT$<?php echo(number_format($product['price'])) ?></td>
                <td>
                    <?php echo($product['quantity']) ?>
                    <input type="hidden" name="quantity[]" value="<?php echo($product['id']) ?>"/>
                </td>
                <td>NT$<?php echo(number_format($price)) ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right">
                    價格總計 NT$<?php echo(number_format($total)) ?><br/>
                </td>
            </tr>
        </tfoot>
    </table>
    <div class="card border-light mb-3">
        <div class="card-header">$_POST 變數內容</div>
        <div class="card-body">
            <h4 class="card-title">var_dump($_POST)</h4>
            <pre><?php var_dump($_POST) ?></pre>
        </div>
    </div>
    <footer id="footer">
        <div class="row">
            <div class="col-lg-12">
                <p>&copy; 2019 Ming Tsay.</p>
            </div>
        </div>
    </footer>
</div>
