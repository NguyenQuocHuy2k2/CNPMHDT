<?php 
require "config.php";
require "models/db.php";
require "models/order.php";
require "models/orderdetail.php";

$order = new Order;
$orderdetail = new OrderDetail;

if(isset($_GET['order_id'])){
    $order->DeleteOrderByID($_GET['order_id']);
    $orderdetail->DeleteOrderDetailByID($_GET['order_id']);
    header('location:./orders.php?status=sd');
}
