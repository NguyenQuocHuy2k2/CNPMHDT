<?php
session_start();
require "config.php";
require "models/db.php";
require "models/product.php";
$product = new Product;
$getAllProducts = $product->getAllProducts();
if(isset($_SESSION['user'])) {
    if(isset($_GET['ids']) && isset($_SESSION['cart'])) {
        $ids = explode(',', $_GET['ids']); // Tách chuỗi giá trị ID thành mảng
        header('location:./checkout.php?ids='.implode(',', $ids)); // Truyền các ID sản phẩm qua URL
    }
}
else
{
    header('location:./login/index.php');
}