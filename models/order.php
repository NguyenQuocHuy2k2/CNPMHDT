<?php
class Order extends Db
{

    public function addOrder($user_id, $address, $phone, $total, $note)
    {
        $sql = self::$connection->prepare("INSERT INTO `orders`(`user_id`, `address`, `phone`, `total`, `note`) VALUES (?,?,?,?,?)");
        $sql->bind_param("issis", $user_id, $address, $phone, $total, $note);
        $sql->execute();
        $order_id = self::$connection->insert_id;
        return $order_id;
    }
    
    public function getOrderByUserID($user_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM `orders` WHERE `user_id`=? ORDER BY `order_id` DESC");
        $sql->bind_param("i", $user_id);
        $sql->execute();
        $item = array();
        $item = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $item; //return an array
    }
    public function getOrderByOrderID($order_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM `orders` WHERE `order_id`=?");
        $sql->bind_param("i", $order_id);
        $sql->execute();
        $item = array();
        $item = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $item; //return an array
    }
    public function DeleteOrderByID($order_id)
    {
        $sql = self::$connection->prepare("DELETE FROM `orders` WHERE `order_id`=?");
        $sql->bind_param("i", $order_id);
        return $sql->execute();
    }

    public function ReceivedOrder($order_id){
        $sql = self::$connection->prepare("UPDATE `orders` SET `status`=1 WHERE `order_id`=?");
        $sql->bind_param("i", $order_id);
        return $sql->execute();
    }
}
