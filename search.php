<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<!-- <link type="text/css" rel="stylesheet" href="css/style2.css" /> -->

<!-- <hr> -->
<br>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$tukhoa = $_POST['tukhoa'];
	$search_product = $product->search_product($tukhoa);
}
?>


<div class="container">
	<!-- <div class="heading">
		<h3>Từ khóa tìm kiếm : <?php if (isset($tukhoa)) echo $tukhoa ?></h3>
	</div>

	<div class="clear"></div> -->
		<div class="row">
			<?php

			// if (($search_product)) {
			// 	while ($result = $search_product->fetch_assoc()) {
			?>
					<!-- <div class="grid_1_of_4 images_1_of_4">
						<a href="preview-3.php"><img src="admin/uploads/<?php echo $result['image'] ?>" width="200px" alt="" /></a>
						<h2><?php echo $result['productName'] ?></h2>
						<p><?php echo $fm->textShorten($result['product_desc'], 50); ?></p>
						<p><span class="price"><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></span></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
					</div> -->

			<?php
			// 	}
			// } else {
			// 	echo '<h2>Category Not Avaiable</h2>';
			// }
			?>
			<?php
			if (($search_product)) {
				while ($result = $search_product->fetch_assoc())
			{

			?>

					<!-- product -->
					<div class="col-md-3 col-xs-6">
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
	</div>
	<?php
	include 'inc/footer.php';

	?>