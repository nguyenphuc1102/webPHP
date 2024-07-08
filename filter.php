<?php
include_once 'lib/session.php';
Session::init();
include 'lib/database.php';
include 'helpers/format.php';
spl_autoload_register(function ($class) {
	require_once "classes/" . $class . ".php";
});
$product = new product();
$fm = new Format();
if (isset($_POST['action']) && $_POST['action'] == 'filterData') {

	$query = "SELECT * FROM tbl_product where 1 ";
	if (isset($_POST['priceMin'], $_POST['priceMax']) && !empty($_POST['priceMax'])) {
		$min = $_POST['priceMin'];
		$max = $_POST['priceMax'];
		$query .= " AND price BETWEEN $min AND $max ";
	}

	if (isset($_POST['brand']) && !empty($_POST['brand'])) {
		// $brand = implode("','",$_POST['brand']) ;
		print_r($_POST['brand']);
		foreach ($_POST['brand'] as $key => $val) {
			$query .= " AND brandId ='$val' ";
		}
		// $query .=" AND brandId in ('$val')";
	}
	if (isset($_POST['category']) && !empty($_POST['category'])) {
		// $brand = implode("','",$_POST['brand']) ;
		// print_r($_POST['category']);
		// $query .=" AND brand "; 
		foreach ($_POST['category'] as $key => $val) {
			$query .= " AND catId ='$val' ";
		}
		// $query .=" AND brandId in ('$val')";
	}
	if (isset($_POST['sortPrice']) && !empty($_POST['sortPrice'])) {
		if($_POST['sortPrice']==0){
			$query = "SELECT * FROM tbl_product order by productName";
		}else{
			$query = "SELECT * FROM tbl_product order by productName desc";

		}
	}
	$limit = 9;
	if (isset($_GET['trang'])) {
		$trang = $_GET['trang'];
	} else {
		$trang = 1;
	}
	$start = ($trang - 1) * $limit;
	$filter = $product->filter($query, $start, $limit);
	// print_r($_POST);
	// echo $query;


	if (!isset($_POST['brand']) && !isset($_POST['category']) && $_POST['priceMax'] == "50000000.00" &&  $_POST['priceMin'] == "1000000.00") {
		// $query= "SELECT * FROM tbl_product ";
		// $filter = $product->filter($query,0,20) ;
	}



	if ($filter) {
		echo "Tìm thấy" . mysqli_num_rows($filter) . " sản phẩm";
?>
		<div class="store-filter clearfix">
			<div class="store-sort">
				<label>
					Sắp xếp:
					<select id="sortPrice" class="input-select">
						<option value="">Chữ cái</option>
						<option value="0">A-Z</option>
						<option value="1">Z-A</option>
					</select>
				</label>

				<!-- <label>
					Show:
					<select class="input-select">
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
		<?php

		// $get_all_product = $product->getproduct_topSelling($start, $limit);
		// if ($get_all_product) {
		// 	$i = 0;
		?>
		<div class="row">
			<?php

			while ($result = $filter->fetch_assoc()) {
			?>
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
			<?php } ?>
		</div>
		<div class="store-filter clearfix">
			<span class="store-qty">Showing 20-100 products</span>
			<ul class="store-pagination">
				<?php
				$filter = $product->filter($query, 0, 30);

				if (mysqli_num_rows($filter)) {
					$product_count = mysqli_num_rows($filter);
					$product_a = ceil($product_count / $limit);
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
				<?php }
				}
				?>
			</ul>
		</div>
<?php
	} else echo "không tìm thấy kết quả";
}
?>
<?php
	if (isset($_POST['action']) && $_POST['action'] == 'search') {
	// $query = "SELECT * FROM tbl_product where productName LIKE %% OR brandName";
	$searchName = $_POST['search_name'];
	$filterSearch = $product->search_product($searchName);
	if ($filterSearch) {
		while ($result = $filterSearch->fetch_assoc()) {
			?>
			<li>
				<div class="row">
				<div class="col-md-2"><a href="index.php?action=detail&proId=<?php echo $result['productId'] ?>"><img src="./admin/uploads/<?php echo $result["image"]?>" style="width:60px" ></a></div>
				<div class="col-md-10"><a href="index.php?action=detail&proId=<?php echo $result['productId'] ?>"><?php echo $result["productName"]?></a></div>
				<div class="col-md-4"><span style="color:#d10024;"><?php echo $fm->format_currency($result["price"]) ." VNĐ"?></span></div>

				</div>
			</li>
			<!-- echo "<li>" . $result["productName"] . "</li>"; -->
		
		<?php
			}
		}else{
			echo "<li>Không tìm thấy kết quả nào </li>";
		}
	}
	?>