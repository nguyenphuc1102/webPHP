<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
	<link type="text/css" rel="stylesheet" href="css/main.css" />

<?php
//    if(isset($_GET['cartid'])){
//        $cartid = $_GET['cartid']; 
//        $delcart = $ct->del_product_cart($cartid);
//    }

// if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
//        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
//        $cartId = $_POST['cartId'];
//        $quantity = $_POST['quantity'];
//        $update_quantity_Cart = $ct -> update_quantity_Cart($cartId, $quantity); // hàm check catName khi submit lên
//    	if ($quantity <= 0) {
//    		$delcart = $ct->del_product_cart($cartId);
//    	}
//    } 
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:index.php?action=login');
}
?>
<?php
if (isset($_GET['confirmid'])) {
	$id = $_GET['confirmid'];
	$time = $_GET['time'];
	$price = $_GET['price'];
	$shifted_confirm = $ct->shifted_confirm($id, $time, $price);
}
?>
<main id="main-container" class="main-container">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-content">
					<h5 style="margin-top:20px;" class="section-content__title">Lịch sử đơn hàng</h5>
				</div>
				<!-- Start Cart Table -->
				<div class="table-content table-responsive cart-table-content m-t-30">
					<table>
						<thead class="gray-bg">
							<tr>
								<th>Tên sản phẩm</th>
								<th>Hình ảnh</th>
								<th>Giá</th>
								<th>Số lượng</th>
								<!-- <th>Tiền</th> -->
								<th>Ngày</th>
								<th>Trạng thái</th>
								<th>Xử lý</th>

							</tr>
						</thead>
						<tbody>
							<?php

							$customer_id = Session::get('customer_id');
							$get_cart_ordered = $ct->get_cart_ordered($customer_id);
							if ($get_cart_ordered) {
								$i = 0;
								$qty = 0;
								while ($result = $get_cart_ordered->fetch_assoc()) {
									$i++;
							?>
									<tr>
										<td class="product-thumbnail">
											<a href="index.php?action=detail&proId=<?php echo $result['productId'] ?>"><img class="img-fluid" src="admin/uploads/<?php echo $result['image'] ?>" width="106px" height="69px" alt=""></a>
										</td>
										<td class="product-name"><a href="index.php?action=detail&proId=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a></td>
										<td class="product-price-cart"><span class="amount"><?php echo $fm->format_currency($result['price']) . " VNĐ" ?></span></td>
										<td class="product-quantities"><?php echo $result['quantity'] ?>
										</td>
										<!-- <td class="product-subtotal">
											<?php
											$total = $result['price'] * $result['quantity'];
											echo $fm->format_currency($total) . " " . "VNĐ";
											?>
										</td> -->
										<td class="product-subtotal">
											<?php echo $fm->formatDate($result['date_order'])  ?>
										</td>
										<td class="product-remove">
											<?php
											if ($result['status'] == '0') {
												echo "Đang chờ xử lý";
											} elseif ($result['status'] == 1) {
											?>
												<span>Đã gửi hàng</span>

											<?php

											} elseif ($result['status'] == 2) {
												echo 'Đã nhận';
											}
											?>
										</td>
										<?php
											if ($result['status'] == '0') {
											?>

												<td class="product-remove"><?php echo 'N/A'; ?></td>

											<?php
											} elseif ($result['status'] == 1) {
											?>
												<td class="product-remove">
													<a href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Xác nhận</a>
												</td>
											<?php
											} else {
											?>

									<td class="product-remove"><?php echo 'Đã nhận'; ?></td>
								<?php
								}
								?>
									</tr>
							<?php
								}
							}

							?>
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
</main>
<!-- <div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Chi tiết của bạn đã đặt hàng</h2>

				<table class="tblone">
					<tr>
						<th width="0%">STT</th>
						<th width="25%">Tên sản phẩm</th>
						<th width="20%">Hình ảnh</th>
						<th width="15%">Giá</th>
						<th width="15%">SL</th>
						<th width="10%">Ngày</th>
						<th width="10%">Trạng thái</th>
						<th width="10%">Xử lý</th>
					</tr>
					<?php
					$customer_id = Session::get('customer_id');
					$get_cart_ordered = $ct->get_cart_ordered($customer_id);
					if ($get_cart_ordered) {
						$i = 0;
						$qty = 0;
						while ($result = $get_cart_ordered->fetch_assoc()) {
							$i++;
					?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" width="100px" /></td>
								<td><?php echo $result['price'] . ' VND' ?></td>
								<td><?php echo $result['quantity'] ?></td>
								<td><?php echo $fm->formatDate($result['date_order'])  ?></td>
								<td>
									<?php
									if ($result['status'] == '0') {
										echo "Đang chờ xử lý";
									} elseif ($result['status'] == 1) {
									?>
										<span>Đã gửi hàng</span>

									<?php

									} elseif ($result['status'] == 2) {
										echo 'Đã nhận';
									}
									?>

								</td>
								<?php
								if ($result['status'] == '0') {
								?>

									<td><?php echo 'N/A'; ?></td>

								<?php
								} elseif ($result['status'] == 1) {
								?>
									<td>
										<a href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Xác nhận</a>
									</td>
								<?php
								} else {
								?>

									<td><?php echo 'Đã nhận'; ?></td>
								<?php
								}
								?>
							</tr>
					<?php
						}
					}
					?>

				</table>

			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div> -->

<?php
include 'inc/footer.php';
?>