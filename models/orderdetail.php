<?php
class OrderDetail extends Db
{
    public function getAllOrderDetails(){
        $sql = self::$connection->prepare("SELECT * FROM order_details");
        $sql->execute(); //return an object
        $item = array();
        $item = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $item; //return an array
    }
    public function getAllOrderDetailsByOrderId($order_id){
        $sql = self::$connection->prepare("SELECT * FROM order_details WHERE order_id=?");
        $sql->bind_param("i", $order_id);
        $sql->execute();
        $item = array();
        $item = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $item; //return an array
    }
    public function addOrderDetail($order_id, $product_name, $product_price, $product_quantity, $cost, $product_id, $type_id, $product_image)
    {
        $sql = self::$connection->prepare("INSERT INTO `order_details`(`order_id`, `product_name`,`product_price`,`product_quantity`, `cost`, `product_id`, `type_id`, `product_image`) VALUES (?,?,?,?,?,?,?,?)");
        $sql->bind_param("isiiiiis", $order_id, $product_name, $product_price, $product_quantity, $cost, $product_id, $type_id, $product_image);
        $sql->execute();
    }
    public function DeleteOrderDetailByID($order_id)
    {
        $sql = self::$connection->prepare("DELETE FROM `order_details` WHERE `order_id`=?");
        $sql->bind_param("i", $order_id);
        return $sql->execute();
    }
}
