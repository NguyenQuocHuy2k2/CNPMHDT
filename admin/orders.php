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
                        <li class="breadcrumb-item active">Orders</li>
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
                <h3 class="card-title">Orders</h3>

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
                            <th style="width: 5%">
                                ORDER_ID
                            </th>
                            <th style="width: 5%">
                                USER_ID
                            </th>
                            <th style="width: 30%" class="text-center">
                                ADDRESS
                            </th>
                            <th style="width: 10%">
                                PHONE
                            </th>
                            <th style="width: 5%">
                                TOTAL
                            </th>
                            <th style="width: 15%" class="text-center">
                                NOTE
                            </th>
                            <th style="width: 10%" class="text-center">
                                STATUS
                            </th>
                            <th style="width: 10%">
                                DATE_CREATED
                            </th>
                            <th style="width: 10%" class="text-center">
                                DETAILS
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $getAllOrderDetail = $orderdetail->getAllOrderDetails();
                        $getAllOrdersDESC = $order->getAllOrdersDESC();
                        foreach ($getAllOrdersDESC as $value) :
                        ?>
                            <tr>
                                <td class="text-center" style="width: 5%"><?php echo $value['order_id'] ?></td>
                                <td class="text-center" style="width: 5%"><?php echo $value['user_id'] ?></td>
                                <td class="text-center" style="width: 30%"><?php echo $value['address'] ?></td>
                                <td style="width: 10%"><?php echo $value['phone']?></td>
                                <td style="width: 5%"><?php echo number_format($value['total'],0,',','.')?>đ</td>
                                <td style="width: 15%"><?php echo $value['note'] ?></td>
                                <td class="text-center" style="width: 10%"><?php if ($value['status'] == 0) {
                                        echo 'Đang giao';
                                    } else {
                                        echo 'Đã giao';
                                    } ?></td>
                                <td style="width: 10%"><?php echo $value['date_create'] ?></td>
                                <td class="project-actions text-right">
                                    <a class="btn  btn-sm bg-green" href="orderdetail.php?order_id=<?php echo $value['order_id']; ?>">
                                        <i class="fa fa-eye" >
                                        </i>
                                        View
                                    </a>
                                </td>
                            </tr>
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