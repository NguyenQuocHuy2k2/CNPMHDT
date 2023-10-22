<?php
require "config.php";
require "models/db.php";
require "models/product.php"; 
require "models/manufacture.php"; 
require "models/protype.php";
require "models/sale.php";

$product = new Product;
$manufacture = new Manufacture;
$protype = new Protype;
$sale = new Sale;

if(isset($_GET['id'])){
    if(isset($_GET['confirm']) && $_GET['confirm'] == 'yes'){
        $product->deleteProduct($_GET['id']);
        header('location:products.php?status=dc');
    } else {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Xác nhận xóa sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
        }

        h3 {
            margin: 0 0 15px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        button {
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        button:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Bạn có chắc chắn muốn xóa sản phẩm này?</h3>
        <table>
            <?php
            $id = $_GET['id'];
            $getProductById = $product->getProductById($id);
            foreach ($getProductById as $value) :
            ?>
              <tr>
                <td>Tên sản phẩm:</td>
                <td><?php echo $value['name'] ?></td>
              </tr>
              <tr>
                <td><img style="width:50px" src="../img/<?php echo $value['pro_image'] ?>" alt=""></td>
              </tr>
            <?php endforeach; ?>
        </table>

        <form method="get">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="confirm" value="yes">
            <button type="submit">Có</button>
        </form>
        <a href="products.php">Không</a>
    </div>
</body>

</html>
<?php
    }
}?>
            
