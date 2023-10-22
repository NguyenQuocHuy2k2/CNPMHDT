<?php include "./admin/header.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Xác nhận xóa sản phẩm</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h3>Bạn có chắc chắn muốn xóa sản phẩm này?</h3>
        <form method="get">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="confirm" value="yes">
            <button type="submit">Có</button>
            <a href="products.php">Không</a>
        </form>
    </div>
</body>
</html>
<?php include "./admin/footer.php"; ?>
