	<?php
	//    if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
	//     echo "<script> window.location = '404.php' </script>";

	//   }else {
	//     $id = $_GET['catid']; // Lấy catid trên host
	// 	$name_cat = $cat->get_name_by_cat($id);

	// }
	?>
	<!-- BREADCRUMB -->
	<div id="breadcrumb" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb-tree">
						<li><a href="index.php?action=home">Home</a></li>
						<li><a href="#">All Categories</a></li>
						<!-- <li><a href="#">Accessories</a></li> -->
						<!-- <li class="active">Headphones (227,490 Results)</li> -->
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
				<!-- ASIDE -->
				<div id="aside" class="col-md-3">
					<!-- aside Widget -->
					<div class="aside">
						<h3 class="aside-title">Categories</h3>
						<div class="checkbox-filter">
							<?php

							$cate = $cat->show_category();

							if ($cate) {
								$i = 1;
								while ($result_new = $cate->fetch_assoc()) {

							?>

									<div class="input-checkbox">
										<input type="checkbox" class="selector category" id="category-<?php echo $i ?>" value="<?php echo $result_new['catId'] ?>"
										<?php if(isset($_GET['catid']) && $_GET['catid']==$result_new['catId']) echo 'checked'?>>
										<label for="category-<?php echo $i ?>">
											<span></span>
											<?php echo $result_new['catName'] ?>
											<!-- <small>(120)</small> -->
										</label>
									</div>

							<?php
									$i++;
								}
							}
							?>
						</div>
					</div>
					<!-- /aside Widget -->

					<!-- aside Widget -->
					<div class="aside">
						<h3 class="aside-title">Price</h3>
						<div class="price-filter">
							<div id="price-slider"></div>
							<div class="input-number price-min">
								<input id="price-min" type="number" value="">
								<span class="qty-up qty-up-store">+</span>
								<span class="qty-down qty-down-store">-</span>
							</div>
							<span>-</span>
							<div class="input-number price-max">
								<input id="price-max" type="number" value="">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
						</div>
					</div>
					<!-- /aside Widget -->

					<!-- aside Widget -->
					<div class="aside">
						<h3 class="aside-title">Brand</h3>
						<div class="checkbox-filter">
							<?php
							$brand = $br->show_brand_home();
							if ($brand) {
								$i = 1;
								while ($result_new = $brand->fetch_assoc()) {		?>
									<div class="input-checkbox">
										<!-- <input type="hidden" class="selector brand"  value="<?php echo $result_new['brandId'] ?>"> -->
										<input type="checkbox" class="selector brand " id="brand-<?php echo $i ?>" value="<?php echo $result_new['brandId'] ?>">
										<label for="brand-<?php echo $i ?>">
											<span></span>
											<?php echo $result_new['brandName'] ?>

										</label>
									</div>
							<?php
									$i++;
								}
							} ?>

						</div>
					</div>
					<!-- /aside Widget -->

					<!-- aside Widget -->
					<div class="aside">
						<h3 class="aside-title">Hàng bán chạy</h3>
						<?php
						$product_feathered = $product->getproduct_topSelling(1, 3);
						if ($product_feathered) {

							while ($result = $product_feathered->fetch_assoc()) {


						?>
								<div class="product-widget">
									<a href="index.php?action=detail&proId=<?php echo $result['productId'] ?>">
										<div class="product-img">
											<img src="./admin/uploads/<?php echo $result['image'] ?>" width="60px" height="60px" alt="">
										</div>
									</a>
									<div class="product-body">

										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="index.php?action=detail&proId=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a></h3>
										<h4 class="product-price"><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?>
											<!-- <del class="product-old-price">$990.00</del> -->
										</h4>
									</div>
								</div>
						<?php
							}
						} ?>


					</div>
					<!-- /aside Widget -->
				</div>
				<!-- /ASIDE -->

				<!-- STORE -->
				<div id="store" class="col-md-9">
					<!-- store top filter -->
					<div class="store-filter clearfix">
						<div class="store-sort">
							<label>
								Sắp xếp:
								<select id="sortPrice"  class="input-select">
								<option value="">Chữ cái</option>
								<option value="0">A-Z</option>
								<option value="1">Z-A</option>
								</select>
							</label>

							<!-- <label>
								Show:
								<select id="sortPrice" class="input-select">
									<option value="0">20</option>
									<option value="1">50</option>
								</select>
							</label> -->
						</div>
						<ul class="store-grid">
							<li class="active"><i class="fa fa-th"></i></li>
							<li><a href="#"><i class="fa fa-th-list"></i></a></li>
						</ul>
					</div>
					<!-- /store top filter -->

					<!-- store products -->
					<div class="row">
						<?php
						if (isset($_GET['trang'])) {
							$trang = $_GET['trang'];
						} else {
							$trang = 1;
						}
						$limit = 9;
						$start = ($trang - 1) * $limit;
						if (isset($_GET['catid'])) {
							$cate = $cat->get_product_by_cat($_GET['catid']);
						} else {
							$cate = $product->getproduct_store($start, $limit);
						}
						if ($cate) {
							$i = 0;
							while ($result = $cate->fetch_assoc()) {

						?>
								<!-- product -->
								<div class="col-md-4 col-xs-6">
									<div class="product">
										<a href="index.php?action=detail&proId=<?php echo $result['productId'] ?>">
											<div class="product-img">
												<img src="./admin/uploads/<?php echo $result['image'] ?>" width="262px" height="262px" alt="">
												<div class="product-label">
													<!-- <span class="sale">-30%</span>
														<span class="new">NEW</span> -->
												</div>
											</div>
										</a>
										<div class="product-body">
											<p class="product-category">Category</p>
											<h3 class="product-name"><a href="index.php?action=detail&proId=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a></h3>
											<h4 class="product-price"><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></h4>
											<div class="product-rating">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											</div>
											<div class="product-btns">
												<a href="index.php?action=addwishlist&proId=<?php echo $result["productId"] ?>" class="add-to-wishlist"" class=" add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Thêm vào yêu thích</span></a>
												<a class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></a>
												<a class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Xem ngay</span></a>
											</div>
										</div>
										<div class="add-to-cart">
											<a href="index.php?action=cart&xuly=add&proId=<?php echo $result['productId'] ?>" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
										</div>
									</div>
								</div>
								<!-- /product -->
						<?php
							}
						}
						?>


					</div>
					<!-- /store products -->

					<!-- store bottom filter -->
					<div class="store-filter clearfix">
						<span class="store-qty">Showing 20-100 products</span>
						<ul class="store-pagination">
							<?php
							$product_all =$product->get_all_product();
							if($product_all){
							if (isset($_GET['catid'])) {
								$product_all = $cat->get_product_by_cat($_GET['catid']);
							} else{
								$product_all = $product->get_all_product();
							}
							if($product_all){
							$product_count = mysqli_num_rows($product_all);
							$product_a = ceil($product_count / $limit);
							}
							}
							// $trang = $_GET['trang'];
							if ($trang > 1) {
							?>
								<li><a href="index.php?action=store&trang=<?php echo $trang - 1 ?>"><i class="fa fa-angle-left"></i></a></li>
							<?php } ?>

							<?php
							for ($i = 1; $i <= $product_a; $i++) {
							?>
								<li class="<?php if ($trang == $i) echo 'active' ?>"><a style="<?php if ($trang == $i) echo 'color: white;' ?>" href="index.php?action=store&trang=<?php echo $i ?>"><?php echo $i ?></a></li>
							<?php
							}
							?>
							<?php if ($trang < $product_a) { ?>
								<li><a href="index.php?action=store&trang=<?php echo $trang + 1 ?>"><i class="fa fa-angle-right"></i></a></li>
							<?php } ?>
						</ul>
					</div>
					<!-- /store bottom filter -->
				</div>
				<!-- /STORE -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->
	<script type="text/javascript" src="js/jquery.min.js">

	</script>