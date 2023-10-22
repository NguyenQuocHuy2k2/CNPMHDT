<?php
ob_start();
session_start();
if (isset($_SESSION['user'])) {
    include "headeruser.php";
} else {
    include "header.php";
}

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'sd') {
        echo "<script> alert('Hủy đơn hàng thành công'); </script>";
    }
    if ($_GET['status'] == 's') {
        echo "<script> alert('Đặt hàng thành công'); </script>";
    }
    if ($_GET['status'] == 'sr') {
        echo "<script> alert('Nhận hàng thành công'); </script>";
    }
}
ob_end_flush();
?>

<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="css/font-awesome.min.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="css/owl.carousel.css">
<link rel="stylesheet" href="css/style1.css">
<link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form method="post" action="#">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="order-id">ID ĐƠN HÀNG</th>
                                            <th class="product-thumbnail">SẢN PHẨM</th>
                                            <th class="product-cost">THÀNH TIỀN</th>
                                            <th class="product-address">ĐỊA CHỈ</th>
                                            <th class="product-phone">SỐ ĐIỆN THOẠI</th>
                                            <th class="product-status">TÌNH TRẠNG</th>
                                            <th class="product-date-create">NGÀY ĐẶT HÀNG</th>
                                            <th class="product-action">HÀNH ĐỘNG</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $getInfoByUsername = $user->getInfoByUsername($_SESSION['user']);
                                        foreach ($getInfoByUsername as $value) {
                                            $user_id = $value['user_id'];
                                        }
                                        $getOrderByUserID = $order->getOrderByUserID($user_id);

                                        foreach ($getOrderByUserID as $orderInfo) {
                                            $orderDetails = $orderdetail->getAllOrderDetailsByOrderId($orderInfo['order_id']);
                                        ?>
                                        <tr>
                                            <td class="order-id"><?php echo $orderInfo['order_id']; ?></td>
                                            <td class="product-thumbnail">
                                                <?php foreach ($orderDetails as $orderDetail) : ?>
                                                    <div class="product-thumbnail-item">
                                                        <img src="img/<?php echo $orderDetail['product_image']; ?>" alt="<?php echo $orderDetail['product_name']; ?>">
                                                        <div class="product-thumbnail-info">
                                                            <h4><a href="detail.php?id=<?php echo $orderDetail['product_id']; ?>&type_id=<?php echo $orderDetail['type_id']; ?>"><?php echo $orderDetail['product_name']; ?></a></h4>
                                                            <h5><?php echo number_format($orderDetail['discount_price'], 0, ',', '.'); ?>đ</h5>
                                                            <?php $totalPrice = $orderDetail['discount_price'] * $orderDetail['product_quantity']; ?>
                                                            <h5><p>Số lượng: x<?php echo $orderDetail['product_quantity']; ?></p></h5>
                                                            <h5><p>Tổng: <?php echo number_format($totalPrice, 0, ',', '.'); ?>đ</h5>
                                                            <hr style="border-top:1px solid gray;">
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </td>
                                            <td class="product-cost"><h5><?php echo number_format($orderInfo['total'], 0, ',', '.'); ?>đ</td></h5>
                                            <td class="product-address"><h5><?php echo $orderInfo['address']; ?></td></h5>
                                            <td class="product-phone"><h5><?php echo $orderInfo['phone']; ?></td></h5>
                                            <td class="product-status">
                                                <h5><?php
                                                if ($orderInfo['status'] == 1) {
                                                    echo 'Đã nhận hàng';
                                                } else {
                                                    echo 'Đang xử lý';
                                                }
                                                ?></h5>
                                            </td>
                                            <td class="product-date-create">
                                                <h5><?php echo date_format(date_create($orderInfo['date_create']), "d/m/Y H:i:s"); ?></h5>
                                            </td>
                                            <td class="product-action">
                                                <?php if ($orderInfo['status'] == 0) : ?>
                                                    <button class="btn btn-received">
                                                        <a style="text-decoration: none;" href="./received.php?order_id=<?php echo $orderInfo['order_id']; ?>">
                                                            <i class="fa fa-check"></i> ĐÃ NHẬN HÀNG
                                                        </a>
                                                    </button>
                                                    <button class="btn btn-cancel" style="background-color:red;">
                                                        <a style="text-decoration: none;" href="./delorder.php?order_id=<?php echo $orderInfo['order_id']; ?>">
                                                            <i class="fa fa-trash-o"></i> HỦY ĐƠN HÀNG
                                                        </a>
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?>
