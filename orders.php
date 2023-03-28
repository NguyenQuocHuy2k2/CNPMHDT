<?php
ob_start();
session_start();
if (isset($_SESSION['user'])) {
    include "headeruser.php";
} else {
    include "header.php";
}

if(isset($_GET['status'])){
    if ($_GET['status']=='sd') {
        echo "<script> alert('Hủy đơn hàng thành công'); </script>";
    }
    if($_GET['status']=='s'){
        echo "<script> alert('Đặt hàng thành công'); </script>";
    }
    if($_GET['status']=='sr'){
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

                                    <!-- -->
       
                                    <!-- --->
                                    <?php
                                        $getInfoByUsername = $user->getInfoByUsername($_SESSION['user']);
                                        foreach ($getInfoByUsername as $value) {
                                            $user_id = $value['user_id'];
                                        }
                                        $getOrderByUserID = $order->getOrderByUserID($user_id);
                                        $getAllProducts = $product->getAllProducts();
                                        $getAllOrderDetail = $orderdetail->getAllOrderDetails();

                                        // Khởi tạo một mảng để lưu trữ thông tin đơn hàng theo order_id
                                        $orders = array();

                                        foreach ($getOrderByUserID as $orderInfo) {
                                            // Tạo một mảng để lưu trữ thông tin của mỗi đơn hàng
                                            $order = array();
                                            $order['order_id'] = $orderInfo['order_id'];
                                            $order['address'] = $orderInfo['address'];
                                            $order['phone'] = $orderInfo['phone'];
                                            $order['status'] = $orderInfo['status'];
                                            $order['total'] = $orderInfo['total'];
                                            $order['date_create'] = $orderInfo['date_create'];

                                            // Khởi tạo một mảng để lưu trữ các sản phẩm của đơn hàng theo order_id
                                            $products = array();
                                            foreach ($getAllOrderDetail as $orderDetail) {
                                                
                                                    if ($orderInfo['order_id'] == $orderDetail['order_id']) {
                                                        // Lấy thông tin sản phẩm từ $getAllProducts dựa vào product_id
                                                        foreach ($getAllProducts as $product) {
                                                            if ($orderDetail['product_id'] == $product['id']) {
                                                                $productInfo = array();
                                                                $productInfo['id'] = $orderDetail['product_id'];
                                                                $productInfo['name'] = $orderDetail['product_name'];
                                                                $productInfo['quantity'] = $orderDetail['product_quantity'];
                                                                $productInfo['price'] = $orderDetail['product_price'];
                                                                $productInfo['cost'] = $orderDetail['cost'];
                                                                $productInfo['type_id'] = $orderDetail['type_id'];
                                                                $productInfo['image'] = $orderDetail['product_image'];
                                                                $products[] = $productInfo;
                                                            }
                                                        }
                                                    }
                                            }
                                            // Gán mảng $products vào $order
                                            $order['products'] = $products;

                                            // Thêm mảng $order vào mảng $orders
                                            $orders[] = $order;
                                        }
                                        ?>
                                        <!-- Hiển thị các đơn hàng và sản phẩm của chúng -->
                                        <?php foreach ($orders as $order) : ?>
                                            <tbody>
                                                <tr>
                                                    <th class="order-id">ID ĐƠN HÀNG</th>
                                                    <th class="product-thumbnail">SẢN PHẨM</th>
                                                    <th class="product-price">ĐƠN GIÁ</th>
                                                    <th class="product-cost">THÀNH TIỀN</th>
                                                    <th class="product-address">ĐỊA CHỈ</th>
                                                    <th class="product-phone">SỐ ĐIỆN THOẠI</th>
                                                    <th class="product-status">TÌNH TRẠNG</th>
                                                    <th class="product-date-create">NGÀY ĐẶT HÀNG</th>
                                                    <th class="product-action">HÀNH ĐỘNG</th>
                                                </tr>
                                                <tr>
                                                    <td class="order-id"><?php echo $order['order_id']; ?></td>
                                                        <td class="product-thumbnail"><?php foreach ($order['products'] as $product) : ?>
                                                        <div class="product-thumbnail-item"><img src="img/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                                                            <div class="product-thumbnail-info">
                                                                <h4><a href="detail.php?id=<?php echo $product['id'] ?>&type_id=<?php echo $product['type_id'] ?>"><?php echo $product['name']; ?></h4>
                                                                <h5><p>Số lượng: x<?php echo $product['quantity']; ?></p></h5>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; ?>
                                                        </td>
                                                    <td class="product-price-item">
                                                        <?php foreach ($order['products'] as $product) : ?>
                                                        <div class="product-thumbnail-item">
                                                        <?php echo number_format($product['price'],0,',','.'); ?>đ
                                                    </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                    </td>
                                                    <td class="product-cost"><?php echo number_format($order['total'], 0, ',', '.'); ?>đ</td>
                                                        <td class="product-address"><?php echo $order['address']; ?></td>
                                                            <td class="product-phone"><?php echo $order['phone']; ?></td>
                                                                <td class="product-status"><?php if($order['status'] == 1){
                                                                    echo 'Đã nhận hàng';
                                                                    }
                                                                    else{
                                                                        echo 'Đang xử lý';
                                                                    } ?>
                                                                </td>
                                                        <td class="product-date-create"><?php echo date_format(date_create($order['date_create']), "d/m/Y H:i:s"); ?></td>
                                                        <td class="product-action">
                                                            <?php if ($order['status'] == 0) : ?>
                                                            <button class="btn btn-received"><a style="text-decoration: none;" href="./received.php?order_id=<?php echo $order['order_id'] ?>"><i class="fa fa-check"></i> ĐÃ NHẬN HÀNG</a></button>
                                                            <button class="btn btn-cancel"><a style="text-decoration: none;" href="./delorder.php?order_id=<?php echo $order['order_id'] ?>"><i class="fa fa-trash-o"></i> HỦY ĐƠN HÀNG</a></button>
                                                            <?php endif; ?>
                                                        </td>
                                                </tr>
                                        </tbody>
                                    <?php endforeach; ?>
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