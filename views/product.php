<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->

</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<?php
// $date = date("d/m/Y");
// echo $date;
?>
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- Product main img -->
			<div class="col-md-5 col-md-push-2">
				<div id="product-main-img">
					<!-- <img src="/admin/uploads/<?php echo $val ?>" alt=""> -->
					<?php
					// $data = $product->getImageByProductId($productid);

					foreach ($data as $img => $val) {
						// echo $val."<br>";
					?>
						<div class="product-preview">
							<img src="./admin/uploads/<?php echo $val ?>" alt="<?php echo $val ?>">
						</div>
					<?php } ?>

					<!-- <div class="product-preview">
						<img src="./img/product03.png" alt="">
					</div>

					<div class="product-preview">
						<img src="./img/product06.png" alt="">
					</div>

					<div class="product-preview">
						<img src="./img/product08.png" alt="">
					</div> -->
				</div>
			</div>
			<!-- /Product main img -->

			<!-- Product thumb imgs -->
			<div class="col-md-2  col-md-pull-5">
				<div id="product-imgs">

					<?php
					// $data = $product->getImageByProductId($productid);

					foreach ($data as $img => $val) {
						// echo $val."<br>";
					?>
						<div class="product-preview">
							<img src="./admin/uploads/<?php echo $val ?>" alt="<?php echo $val ?>">
						</div>
					<?php } ?>
				</div>
			</div>
			<!-- <div class="col-md-7">
			<img src="https://interactive-examples.mdn.mozilla.net/media/cc0-images/grapefruit-slice-332-332.jpg">
		</div> -->
			<!-- /Product thumb imgs -->

			<!-- Product details -->
			<div class="col-md-5 ">
				<div class="product-details">
				<?php $get_comment = $cs->getComment($productid);
							if ($get_comment) $review = mysqli_num_rows($get_comment); ?>
					<?php

					$get_product_details = $product->get_details($productid);
					if ($get_product_details) {
						while ($result = $get_product_details->fetch_assoc()) {


					?>
							<h2 class="product-name"><?php echo $result['productName'] ?></h2>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star fa-star-half "></i>
								</div>
								<a class="review-link" href="#"><?php if ($get_comment) {
																			echo $review;
																		} else echo 0  ?> Đánh giá </a>
							</div>
							<div>
								<h3 class="product-price"> <?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></h3>
								<span class="product-available">Còn hàng</span>
							</div>
							<!-- <p><?php ?></p> -->

							<!-- <div class="product-options">
						<label>
							Size
							<select name="size" class="input-select">
								<option value="0">X</option>
							</select>
						</label>
						<label>
							Color
							<select class="input-select">
								<option value="0">Red</option>
							</select>
						</label>
					</div> -->

							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number" value="1">
										<!-- <span class="qty-up qty-up-product">+</span>
								<span class="qty-down qty-down-product">-</span> -->
									</div>
								</div>
								<a href="index.php?action=cart&xuly=add&proId=<?php echo $productid ?>" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
							</div>


							<ul class="product-btns">
								<li><a href="index.php?action=addwishlist&proId=<?php echo $result["productId"] ?>" class="add-to-wishlist"><i class="fa fa-heart-o"></i> Thêm vào yêu thích</a></li>
								<!-- <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li> -->
							</ul>

							<ul class="product-links">
								<li>Danh Mục:</li>
								<li><a href="#"><?php echo $result['catName'] ?></a></li>

								<!-- <li><a href="#">Accessories</a></li> -->
							</ul>
							<ul class="product-links">
								<li>Thương Hiệu:</li>
								<li><a href="#"><?php echo $result['brandName'] ?></a></li>

								<!-- <li><a href="#">Accessories</a></li> -->
							</ul>

							<ul class="product-links">
								<li>Chia sẻ:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>


				</div>
			</div>
			<!-- /Product details -->

			<!-- Product tab -->
			<div class="col-md-12">
				<div id="product-tab">
					<!-- product tab nav -->
					<ul class="tab-nav">
						<li class="active"><a data-toggle="tab" href="#tab1">Mô tả </a></li>
						<!-- <li><a data-toggle="tab" href="#tab2">Details</a></li> -->
						<?php $get_comment = $cs->getComment($productid);
							if ($get_comment) $review = mysqli_num_rows($get_comment); ?>
						<li><a data-toggle="tab" href="#tab3">Đánh giá (<?php if ($get_comment) {
																			echo $review;
																		} else echo 0  ?>)</a></li>
					</ul>
					<!-- /product tab nav -->

					<!-- product tab content -->
					<div class="tab-content">
						<!-- tab1  -->
						<div id="tab1" class="tab-pane fade in active">
							<div class="row">
								<div class="col-md-12">
									<p><?php echo $result['product_desc'] ?></p>
								</div>
							</div>
						</div>
						<!-- /tab1  -->

						<!-- tab2  -->
						<!-- <div id="tab2" class="tab-pane fade in">
							<div class="row">
								<div class="col-md-12">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								</div>
							</div>
						</div> -->
						<!-- /tab2  -->

						<!-- tab3  -->
						<div id="tab3" class="tab-pane fade in">
							<div class="row">
								<!-- Rating -->
								<?php
								$getRate = $cs->getRate($result["productId"]);
								if($getRate){
								?>
								<div class="col-md-3">
									<div id="rating">
										<?php
										$getRate = $cs->getRate($result["productId"]);
										$rate = array();
										for ($j = 1; $j <= 5; $j++) {
											$rate['rate' . $j] = 0;
										}
										if ($getRate) {
											$rate_count = mysqli_num_rows($getRate);
											// $product_a = ceil($product_count / $limit);

											$i = 1;
											$SumRate = 0;
											while ($resultRate = $getRate->fetch_assoc()) {
												$SumRate += $resultRate['rate'];
												for ($j = 1; $j <= 5; $j++) {
													if ($resultRate['rate'] == $j)
														$rate['rate' . $j] += 1;
													// $rate = ;
												}
												$i++;
											}
											// var_dump($rate);
										}
										?>
										<div class="rating-avg">
											<span><?php if(isset($SumRate)){ $Sum = ceil($SumRate / $rate_count); echo $Sum; } ;
													 ?></span>
											<div class="rating-stars">
												<?php
												for ($i = 1; $i <= $Sum; $i++) {
												?>
													<i class="fa fa-star"></i>
												<?php } ?>
												<?php $fa0 = 5 - $Sum;
												if ($fa0 !== 0) {
													for ($i = 1; $i <= $fa0; $i++) {
												?>
														<i class="fa fa-star-o empty"></i>
												<?php
													}
												} ?>
											</div>
										</div>
										<ul class="rating">
											<li>
												<?php
												for ($k = 5; $k >= 1; $k--) {

												?>
													<div class="rating-stars">
														<?php
														for ($i = 1; $i <= $k; $i++) {
														?>
															<i class="fa fa-star"></i>
														<?php } ?>
														<?php $fa0 = 5 - $k;
														if ($fa0 !== 0) {
															for ($i = 1; $i <= $fa0; $i++) {
														?>
																<i class="fa fa-star-o empty"></i>
														<?php
															}
														} ?>
														<?php
														// for($l = 1; $l <= $rate['rate'.$k]; $l++){

														?>
														<!-- <i class="fa fa-star"></i>
													 <i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>  -->

													</div>
													<div class="rating-progress">
														<div style="width: <?php echo $rate['rate' . $k] * 120 / $rate_count ?>%;"></div>
													</div>
													<span class="sum"><?php echo $rate['rate' . $k] ?></span>
											</li>
										<?php } ?>
										<!-- <li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div style="width: 60%;"></div>
												</div>
												<span class="sum">2</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">0</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">0</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">0</span>
											</li> -->
										</ul>
									</div>
								</div>
								<?php }?>
								<!-- /Rating -->

								<!-- Reviews -->
								<?php 
								if ($get_comment) {?>
								<div class="col-md-6">
									<div id="reviews">
										<ul class="reviews">
											<?php
											$cout_comment = mysqli_num_rows($get_comment);
											$pageComment = isset($_GET['pageComment']) ? $_GET['pageComment'] : 1;
											$limitComment = 3;
											$start = ($pageComment - 1) * $limitComment;
											$get_comment_page = $cs->getCommentPage($result['productId'], $start, $limitComment);
											// mysqli_num_rows($get_comment);
											if ($get_comment_page) {

												$row = 1;
												while ($resultCM = $get_comment_page->fetch_assoc()) {
											?>
													<li>
														<?php if ($row <= $limitComment) { ?>

															<div class="review-heading">
																<?php
																// $id = Session::get('customer_id');
																$get_customers = $cs->show_customers($resultCM['customerId']);

																if ($get_customers) {
																	while ($resultCS = $get_customers->fetch_assoc()) {

																?>
																		<h5 class="name"><?php echo $resultCS['name'] ?></h5>
																<?php
																	}
																} ?>
																<p class="date"><?php echo $resultCM['date'] ?></p>
																<div class="review-rating">
																	<?php
																	for ($i = 1; $i <= $resultCM['rate']; $i++) {
																	?>
																		<i class="fa fa-star"></i>
																	<?php } ?>
																	<?php $fa0 = 5 - $resultCM["rate"];
																	if ($fa0 !== 0) {
																		for ($i = 1; $i <= $fa0; $i++) {
																	?>
																			<i class="fa fa-star-o empty"></i>
																	<?php
																		}
																	} ?>
																</div>
															</div>
															<div class="review-body">
																<p><?php echo $resultCM['content'] ?></p>
																<?php if (Session::get('customer_id') === $resultCM['customerId']) { ?>
																	<a href="handle.php?act=deleteComment&id=<?php echo $resultCM['commentId'] ?>&proId=<?php echo $resultCM['productId'] ?> " style="cursor: pointer;">Xóa </a>
																<?php } ?>
															</div>
														<?php }
														$row++; ?>
													</li>
												<?php
												} ?>
										</ul>
										<ul class="reviews-pagination">
											<?php
												for ($i = 1; $i <= ceil($cout_comment / $limitComment); $i++) {

											?>
												<li class="<?php if ($i == $pageComment) echo 'active' ?>"><a href="index.php?action=detail&proId=45&pageComment=<?php echo $i ?>#tab3"><?php echo $i ?></a></li>
											<?php } ?>
											<!-- <li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">4</a></li> -->
											<?php if ($i < ceil($cout_comment / $limitComment)) { ?>
												<li><a href="index.php?action=detail&proId=45&pageComment=<?php echo $pageComment + 1 ?>"><i class="fa fa-angle-right"></i></a></li>
											<?php } ?>
										</ul>
									<?php } ?>
									</div>
								</div>
								<?php } ?>
								<!-- /Reviews -->

								<!-- Review Form -->
								<?php // 
								?>
								<div class="col-md-3">
									<div id="review-form">
										<form action="handle.php?act=comment&proId=<?php echo $result['productId'] ?>" method="POST" class="review-form">
											<!-- <input class="input" type="text" name="name" placeholder="Your Name"> -->
											<!-- <input class="input" type="email" placeholder="Your Email"> -->
											<textarea class="input" name="content" placeholder="Your Review"></textarea>
											<div class="input-rating">
												<span>Your Rating: </span>
												<div class="stars">
													<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
													<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
													<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
													<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
													<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
												</div>
											</div>
											<button type="submit" name="comment" class="primary-btn">Submit</button>
										</form>
									</div>
								</div>
								<?php //} else {
								// echo $result['productId'];
								//} 
								?>
								<!-- /Review Form -->
							</div>
						</div>
						<!-- /tab3  -->
					</div>
					<!-- /product tab content  -->
				</div>
			</div>
			<!-- /product tab -->

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->
<!-- Section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-12">
				<div class="section-title text-center">
					<h3 class="title">Related Products</h3>
				</div>
			</div>
			<?php
							$bradId = $result['brandId'];
							$catId  = $result['catId'];
							$getRelatedProduct = $product->getRelatedProduct($bradId, $catId);
							if ($getRelatedProduct) {
								while ($result_relatedPro = $getRelatedProduct->fetch_assoc()) {
			?>
					<!--  -->
					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<a href="index.php?action=detail&proId=<?php echo $result_relatedPro['productId'] ?>">
								<div class="product-img">
									<img src="./admin/uploads/<?php echo $result_relatedPro['image'] ?>" width="263px" height="263px" alt="">
									<div class="product-label">
										<!-- <span class="sale">-30%</span> -->
									</div>
							</a>
						</div>
						<div class="product-body">

							<h3 class="product-name"><a href="index.php?action=detail&proId=<?php echo $result_relatedPro['productId'] ?>"><?php echo $result_relatedPro['productName'] ?></a></h3>
							<h4 class="product-price"><?php echo $fm->format_currency($result_relatedPro['price']) . " " . "VNĐ" ?></h4>
							<div class="product-rating">
							</div>
							<div class="product-btns">
								<a href="index.php?action=addwishlist&proId=<?php echo $result["productId"] ?>" class="add-to-wishlist" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Thêm vào yêu thích</span></a>
								<a class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></a>
								<a class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Xem ngay</span></a>
							</div>
						</div>
						<div class="add-to-cart">
							<a href="index.php?action=cart&xuly=add&proId=<?php echo $result_relatedPro['productId'] ?>" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
						</div>
					</div>
		</div>
		<!-- /product -->
<?php }
							} ?>
<!-- product -->

<!-- /product -->
<?php }
					} ?>
	</div>
	<!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /Section -->
<script>
</script>