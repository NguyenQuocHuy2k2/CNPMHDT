<?php
session_start();
include "headeruser.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<title>Capple - Website bán đồ ăn, trái cây , rau củ trực tuyến</title>

<!-- Google font -->
<link
	href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700"
	rel="stylesheet">

<!-- Bootstrap -->
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

<!-- Slick -->
<link type="text/css" rel="stylesheet" href="css/slick.css" />
<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

<!-- nouislider -->
<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

<!-- Font Awesome Icon -->
<link rel="stylesheet" href="css/font-awesome.min.css">

<!-- Custom stlylesheet -->
<link type="text/css" rel="stylesheet" href="css/style.css" />

</head>

<body>
	<div class="section">
		<div class="container">
			<div class="row">
				<form action="addorderdetail.php?ids=<?php echo $_GET['ids'] ?>"method="post">
					<div class="col-md-7">
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Thông tin người nhận</h3>
							</div>
							<?php if (isset($_SESSION['user'])) :
								$getInfoByUsername = $user->getInfoByUsername($_SESSION['user']);
								foreach ($getInfoByUsername as $value) :
							?>
							<div class="form-group">
								<input class="input" type="text" name="full name"
									placeholder="Full Name"
									value="<?php echo $value['First_name'] . $value['Last_name'] ?>"
									readonly>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address"
									placeholder="Địa chỉ" required>
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="phone"
									placeholder="Điện thoại" value="<?php echo $value['phone'] ?>"
									required>
							</div>
							<?php endforeach ?>
							<?php endif ?>
						</div>
						<div class="row">
							<div class="col-md-8">
								<div class="order-notes">
									<h4>Ghi chú</h4>
									<textarea style="height: 115px; width: 653px" class="input"
										placeholder="Thông điệp bánh ngọt ví dụ: 'Chúc mừng sinh nhật'"
										name="note"></textarea>
								</div>
							</div>
						</div>
						<div class="row-md-5 order-details">
							<div class="section-title text-center">
								<h3 class="title">Đơn hàng của bạn</h3>
							</div>
							<div class="order-summary">
								<div class="order-products">
									<?php if (isset($_SESSION['cart'])) :
									$total_cost = 0;
									$ids = explode(',', $_GET['ids']);
									$getAllProducts = $product->getAllProducts();
									foreach ($getAllProducts as $value) :
										if (in_array($value['id'], $ids)) : ?>
									<div class="order-col">
										<img width="145" height="145" alt="poster_1_up"
											class="shop_thumbnail"
											src="img/<?php echo $value['pro_image']; ?>">
										<div>
											<strong>
												<?php echo $value['name'] ?>
											</strong>
										</div>
									</div>
									<div class="order-col"></div>
									<div class="order-col">
										<div>
											<strong>ĐƠN GIÁ:</strong>
										</div>
										<div style="max-width: 440px;">
											<strong>
												<?php echo number_format($value['price'],0,',','.')?> đ
											</strong>
										</div>
									</div>
									<div class="order-col">
										<div>
											<strong>SỐ LƯỢNG:</strong>
										</div>
										<div>
											<strong>X <?php echo $_SESSION['cart'][$value['id']]?></strong>
										</div>
									</div>
									<div class="order-col">
										<div>
											<strong>TẠM TÍNH:</strong>
										</div>
										<div>
											<strong class="order-cash-total">
												<?php echo number_format($_SESSION['cart'][$value['id']] * $value['price'],0,',','.') ?> đ
											</strong>
										</div>
									</div>
									<?php $total_cost += ($_SESSION['cart'][$value['id']] * $value['price']) ?>
									<hr>
									<?php	
										endif;
											endforeach;	
										endif
										?>
									<div class="order-col">
										<div>
											<strong>TỔNG:</strong>
										</div>
										<div>
											<strong class="order-total">
												<?php echo number_format($total_cost,0,',','.') ?> đ
											</strong>
										</div>
									</div>
									<button class="primary-btn order-submit col-lg-offset-4"
										type="submit" name="submit">
										ĐẶT HÀNG</a>
									</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<?php
	include "footer.php";
?>