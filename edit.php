<?php
include('include.inc.php');

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 0;

$product_query = $db->prepare('SELECT `id`, `name`, `price`, `stock` FROM `products` WHERE `id` = :id');
$product_query->bindValue(':id', $id);
$product_query->execute();

$product = $product_query->fetch();

// 確認是否有該商品存在於資料庫中
if ($product !== false) {
    if ($quantity < 1) {
?>
<!DOCTYPE html>
<meta charset="utf-8"/>
<link rel="stylesheet" href="bootstrap.css"/>
<link rel="stylesheet" href="custom.min.css"/>
<title>編輯購物車</title>
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
                <h1>編輯購物車</h1>
                <p class="lead">修改購物車內商品的數量</p>
            </div>
        </div>
    </div>
    <form action="edit.php?id=<?php echo($id) ?>" method="POST">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th scope="col">商品編號</th>
                    <td><?php echo($product['id']) ?></td>
                </tr>
                <tr>
                    <th scope="col">商品名稱</th>
                    <td><?php echo($product['name']) ?></td>
                </tr>
                <tr>
                    <th scope="col">商品價格</th>
                    <td><?php echo($product['price']) ?></td>
                </tr>
                <tr>
                    <th scope="col">購買數量</th>
                    <td><input value="<?php echo($_SESSION['cart'][$product['id']]['quantity']) ?>" name="quantity" placeholder="請輸入購買數量" type="number"/></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary btn-sm">儲存修改</button>
                        <a href="cart.php" class="btn btn-warning btn-sm">取消修改</a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
    <footer id="footer">
        <div class="row">
            <div class="col-lg-12">
                <p>&copy; 2019 Ming Tsay.</p>
            </div>
        </div>
    </footer>
</div>
<?php
        exit();
    }

    if (!isset($_SESSION['cart'][$product['id']]))
        $_SESSION['cart'][$product['id']] = $product;

    $_SESSION['cart'][$product['id']]['quantity'] = $quantity;
}

header('location: cart.php');
