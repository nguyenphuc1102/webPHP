<?php

$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:index.php?action=login');
}

?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
	$customer_id = Session::get('customer_id');
	$insertOrder = $ct->insertOrder($customer_id);
	
	$delCart = $ct->del_all_data_cart();
	header('Location:success.php');
}
?>


<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Thanh toán</h3>
				<ul class="breadcrumb-tree">
					<li><a href="index.php?action=home">Home</a></li>
					<li class="active">Thanh toán</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-6">
				<!-- Billing Details -->
				<div class="billing-details">
					<div class="section-title">
						<h3 class="title">ĐỊA CHỈ THANH TOÁN</h3>
					</div>
					<?php
					$id = Session::get('customer_id');
					$get_customers = $cs->show_customers($id);
					if ($get_customers) {
						while ($result = $get_customers->fetch_assoc()) {

					?>
							<div class="form-group">
								<input class="input" type="text" name="first-name" value="<?php echo $result['name'] ?>" placeholder="First Name">
							</div>
							<!-- <div class="form-group">
								<input class="input" type="text" name="last-name" placeholder="Last Name">
							</div> -->
							<div class="form-group">
								<input class="input" type="email" name="email" value="<?php echo $result['email'] ?>" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" value="<?php echo $result['address'] ?>" placeholder="Address">
							</div>
							<!-- <div class="form-group">
								<input class="input" type="text" name="city" placeholder="City">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country">
							</div> -->
							<div class="form-group">
								<input class="input" type="text" name="zipcode" value="<?php $zipcode = $result['zipcode'] ? $result['zipcode'] : "không";
																						echo $zipcode; ?>" placeholder="ZIP Code">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="phone" value="<?php echo $result['phone'] ?>" placeholder="Telephone">
							</div>
					<?php
						}
					} ?>
				</div>
				<!-- /Billing Details -->
				<!-- Shiping Details -->
				<!-- /Shiping Details -->

				<!-- Order notes -->
				<!-- /Order notes -->
			</div>

			<!-- Order Details -->
			<div class="col-md-6 order-details">
				<div class="section-title text-center">
					<h3 class="title">Đơn đặt hàng</h3>
				</div>
				<div class="order-summary">
					<div class="order-col">
						<div><strong>Sản phẩm</strong></div>
						<div><strong>Tổng</strong></div>
					</div>
					<div class="order-products">
						<?php
						$get_product_cart = $ct->get_product_cart();
						if ($get_product_cart) {
							$subtotal = 0;
							while ($result = $get_product_cart->fetch_assoc()) {

						?>
								<div class="order-col">
									<div><?php echo $result['quantity'] ?> x <?php echo $result['productName'] ?></div>
									<div>
											<?php 
									$total = $result['price'] * $result['quantity'];
									$subtotal += $total;
									echo $fm->format_currency($total).' VNĐ';
									 ?>
									</div>
								</div>
						<?php }
						 ?>
					</div>
					<div class="order-col">
						<div>Shiping</div>
						<div><strong><?php $shipping=15000;
                                        echo $fm->format_currency($shipping) . " " . "VNĐ"; ?></strong></div>
					</div>
					<div class="order-col">
						<div>Giảm giá</div>
						<div><strong><?php   $discount=0;
                                        echo $fm->format_currency($discount) . " " . "%";  ?></strong></div>
					</div>
					<div class="order-col">
						<div><strong>TỔNG</strong></div>
						<div><strong class="order-total"><?php  $subtotal =$subtotal - $subtotal*$discount + $shipping; echo $fm->format_currency($subtotal) . " " . "VNĐ"; ?></strong></div>
					</div>
					<div class="input-checkbox">
					<input type="checkbox" id="terms">
					<label for="terms">
						<span></span>
						Đã đọc và chấp nhận các<a href="#">điều khoản & điều kiện </a>
					</label>
				</div>
				<a href="index.php?action=checkout&orderid=order" class="primary-btn order-submit">Đặt hàng ngay</a>
		
					<?php }else {
						?>
					<div class="order-col">Giỏ hàng trống.<a href="index.php?action=home"> Mua hàng</a></div>
						
					<?php
					} ?>
				</div>
				<!-- <div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Cheque Payment
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div> -->
					</div>
			<!-- /Order Details -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->