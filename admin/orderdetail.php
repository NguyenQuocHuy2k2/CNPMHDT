<?php include "header.php";
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'ac') {
        echo "<script> alert('Thêm thành công'); </script>";
    }
    if ($_GET['status'] == 'af') {
        echo "<script> alert('Thêm không thành công'); </script>";
    }
}
echo '<script>window.history.pushState({}, document.title, "/" + "/admin/products.php");</script>';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Order Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Orders Details</h3>

                <div class="card-tools">
       
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 10%" class="text-center">
                                IMAGE
                            </th>
                            <th style="width: 25%" class="text-center">
                                NAME
                            </th>
                            <th style="width: 15%" class="text-center">
                                TYPE
                            </th>
                            <th class="text-center">
                                PRICE
                            </th>
                            <th style="width: 10%" class="text-center">
                                QUANTITY
                            </th>
                            <th style="width: 5%" class="text-center">
                                COST
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $getProduct = $product->getProducts();
                        $getProtype = $protype->getAllProtypes();
                        $order_id = $_GET['order_id'];
                        $getAllOrderDetaiByOrderID = $orderdetail->getAllOrderDetailsByOrderId($order_id);
                        foreach ($getAllOrderDetaiByOrderID as $value) :
                            foreach ($getProduct as $value2) :
                                foreach ($getProtype as $value3) :
                                    if($value['product_id'] == $value2['id'] && $value2['type_id'] == $value3['type_id']) :
                        ?>
                            <tr>
                                <td><img style="width:102px" class="text-center" src="../img/<?php echo $value['product_image'] ?>" alt=""></td>
                                <td class="text-center" style="width: 5%"><?php echo $value['product_name'] ?></td>
                                <td class="text-center" style="width: 5%"><?php echo $value3['type_name'] ?></td>
                                <td class="text-center" style="width: 30%"><?php echo number_format($value['discount_price'],0,',','.')?>đ</td>
                                <td class="text-center">x <?php echo $value['product_quantity']?></td>
                                <td style="width: 5%"><?php echo number_format($value['cost'],0,',','.')?>đ</td>
                            </tr>
                                    <?php endif; ?>
                                <?php endforeach;?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include "footer.php" ?>