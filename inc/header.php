<?php

include 'lib/session.php';
Session::init();
ob_start();
?>
<?php

include 'lib/database.php';
include 'helpers/format.php';
include 'email/email.php';

spl_autoload_register(function ($class) {
	include_once "classes/" . $class . ".php";
});

$db = new Database();
$fm = new Format();
$ct = new cart();
$us = new user();
$br = new brand();
$cat = new category();
$cs = new customer();
$product = new product();



?>

<head>
	<title>PT</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags must come first in the head; any other head content must come after these tags -->


	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />
	<!-- <link type="text/css" rel="stylesheet" href="css/main.css" /> -->


	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- Latest compiled and minified JavaScript -->
	<!-- <script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
  </script> -->
	<style>

	</style>
</head>
<style>
	/* .dropdown {
		transition-duration: 5s;
	} */
   
	.main-nav ul {
		padding: 0;
		list-style-type: none;
		background: #fff none repeat scroll 0 0;
		margin-top: 0;
	}

	.main-nav ul li {
		display: inline-block;
		position: relative;
		line-height: 20px;
		text-align: left;

	}

	.main-nav li ul li {
		border-bottom: 1px solid white;
	}

	/* ul li a{
                display: block;
                padding: 8px 25px;
                color: white;
                text-decoration: none;
            } */
	ul li a:hover {
		color: #D10024;
		/* background-color: 	; */
	}

	.main-nav li ul.name_brand {
		opacity: 0.9;
		min-width: 170px;
		background-color: #ffffff;
		color: #15161d;
		display: none;
		position: absolute;
		z-index: 999;
		left: -10px;
		padding: 10px;
	}

	.main-nav li ul.name {
		opacity: 0.9;
		min-width: 230px;
		background-color: #ffffff;
		color: #15161d;
		display: none;
		position: absolute;
		z-index: 999;
		left: -10px;
		padding: 10px;

		border: 1px solid #fcf8e3;
	}

	.main-nav li ul li ul.topic {
		display: none;
	}

	.main-nav li ul li:hover ul.topic {
		display: block;
		left: 100%;
		top: 0%;
		position: absolute;
	}

	.main-nav li:hover ul.name {
		display: block;
	}

	.main-nav li:hover ul.name_brand {
		display: block;
	}

	.main-nav li ul.name li {
		display: block;
		padding: 10px;
	}

	.main-nav li ul.name_brand li {
		display: block;
		padding: 10px;
	}

	/*  */
	.header-ctn>div>a:hover .cart-dropdown {
		opacity: 1;
		position: relative;
		display: block;
		visibility: inherit;
		/* z-index: ; */

	}
	.search-box{
	/* width: 300px; */
	position: relative;
	/* display: inline-block; */
	/* font-size: 14px; */
	}
	.search-box input[type="text"]{
	height: 32px;
	padding: 5px 10px;
	border: 1px solid #CCCCCC;
	font-size: 14px;
	}
	.result{
	background:#fff;
	position: absolute; 
	z-index: 999;
	top: 100%;
	left: 0;
	/* background: #fff; */
	}
	.search-box input[type="search"], .result{
	width: 100%;
	box-sizing: border-box;
	}
	/* CSS cho kết quả */
	.result p{
	margin: 0;
	padding: 7px 10px;
	border: 1px solid #CCCCCC;
	border-top: none;
	cursor: pointer;
	}
	.result p:hover{
	background: #f2f2f2;
	}
	.result li{
  margin: 0;
  padding: 7px 10px;
  border: 1px solid #CCCCCC;
  border-top: none;
  cursor: pointer;
  list-style: none;
  }
  .result li:hover{
  background: #f2f2f2;
  }
</style>
<header>
	<!-- TOP HEADER -->
	<div id="top-header">
		<div class="container">
			<ul class="header-links pull-left">
				<li><a href="#"><i class="fa fa-phone"></i> +084-95-51-84</a></li>
				<li><a href="#"><i class="fa fa-envelope-o"></i> TPT@gmail.com</a></li>
				<li><a href="#"><i class="fa fa-map-marker"></i> 470 Đường Trần Đại Nghĩa, Hoà Hải, Ngũ Hành Sơn, Đà Nẵng 550000</a></li>
			</ul>
			<ul class="header-links pull-right">
				<li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
				<li class="dropdown">
					<?php
					$login_check = Session::get('customer_login');
					if ($login_check == false) {
					?>

						<a href="index.php?action=login"><i class="fa fa-user-o"></i>Đăng Nhập</a>
					<?php } else { ?> <a href="index.php?action=logout"><i class="fa fa-user-o"></i>Chào <?php echo Session::get('customer_name') ?>,Đăng Xuất</a>
					<?php } ?>
					<!-- <ul class="dropdown-content">
					<li><a href="#"></a>sd</li>
					<li><a href="#"></a>sd</li>
				</ul> -->
				</li>
			</ul>
		</div>
	</div>
	<!-- /TOP HEADER -->

	<!-- MAIN HEADER -->
	<div id="header">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- LOGO -->
				<div class="col-md-3">
					<div class="header-logo">
						<a href="index.php?action=home" class="logo">
							<img src="./img/logo.png" alt="">
						</a>
					</div>
				</div>
				<!-- /LOGO -->

				<!-- SEARCH BAR -->
				<div class="col-md-6">
					<div class="header-search search-box">
						<form action="search.php" method="POST">
							<select class="input-select">
								<option value="0">Danh mục</option>
								<!-- <option value="1">Category 01</option>
								<option value="1">Category 02</option> -->
							</select>
							<input id ='search'class="input" name="tukhoa" placeholder="Search here">
							<button class="search-btn">Search</button>
						</form>
						<div class=" result" id="resultSearch"></div>
					</div>
				</div>
				<!-- /SEARCH BAR -->

				<!-- ACCOUNT -->
				<div class="col-md-3 clearfix">
					<div class="header-ctn">
						<!-- Wishlist -->
						<?php if (Session::get('customer_id')) { ?>
							<div>
								<a href="index.php?action=wishlist">
									<i class="fa fa-heart-o"></i>
									<span>Yêu thích</span>
									<!-- <div class="qty"></div> -->
								</a>
							</div>
						<?php } ?>
						<!-- Cart -->
						<div class="dropdown">
							<a href="index.php?action=cart" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<i class="fa fa-shopping-cart"></i>
								<span>Giỏ hàng</span>
								<div class="qty"><?php if (Session::get('qty')) {
														echo Session::get('qty');
													} else echo 0; ?></div>
							</a>
							<?php
							if(Session::get('qty')){ ?>
							<div class="cart-dropdown">
								<div class="cart-list">
									<?php 
									$get_product_cart = $ct->get_product_cart();
									if ($get_product_cart) {
										$subtotal = 0;
										$qty = 0;
										$i = 0;
										while ($result = $get_product_cart->fetch_assoc()) {
											$i++;

										?>

									<div class="product-widget">
										<div class="product-img">
											<img src="./admin/uploads/<?php echo $result['image'] ?>" alt="">
										</div>
										<div class="product-body">
											<h3 class="product-name"><a href="index.php?action=detail&proId=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a></h3>
											<h4 class="product-price"><span class="qty"> <?php echo $result['quantity'] ?> x </span><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></h4>
										</div>
										<button class="delete"><i class="fa fa-close"></i></button>
									</div>
								<?php
								$total = $result['quantity']*$result['price'];
								$subtotal += $total;
								$qty = $qty + $result['quantity'];
								Session::set('sum', $subtotal);
								Session::set('qty', $qty);
										}
									}
								?>
									<!-- <div class="product-widget">
										<div class="product-img">
											<img src="./img/product02.png" alt="">
										</div>
										<div class="product-body">
											<h3 class="product-name"><a href="#">product name goes here</a></h3>
											<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
										</div>
										<button class="delete"><i class="fa fa-close"></i></button>
									</div> -->
								</div>
								<div class="cart-summary">
									<small> Số lượng(<?php echo $qty ?>) </small>
								
									<h5>Tổng: <?php if($qty){echo $fm->format_currency($subtotal) . " " . "VNĐ" ; }?></h5>
								</div>
								<div class="cart-btns">
									<a href="index.php?action=cart">View Cart</a>
									<a href="index.php?action=checkout">Checkout <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
						<?php } ?>
						<!-- /Cart -->

						<!-- Menu Toogle -->
						<div class="menu-toggle">
							<a href="#">
								<i class="fa fa-bars"></i>
								<span>Menu</span>
							</a>
						</div>
						<!-- /Menu Toogle -->
					</div>
				</div>
				<!-- /ACCOUNT -->
			</div>
			<!-- row -->
		</div>
		<!-- container -->
	</div>
	<!-- /MAIN HEADER -->
</header>
<!-- NAVIGATION -->
<nav id="navigation">
	<!-- container -->
	<div class="container">
		<!-- responsive-nav -->
		<div id="responsive-nav" style="font-size:16px">
			<!-- NAV -->
			<ul class="main-nav nav navbar-nav">
				<li class="<?php if (!isset($_GET['action'])) echo 'active' ?>"><a href="index.php?action=home">Trang chủ</a>

				</li>
				<!-- <li><a href="#">Hot Deals</a></li> -->
				<li class="<?php if (isset($_GET['action']) and $_GET['action'] == 'store') echo 'active' ?>"><a href="index.php?action=store">Danh Mục Sản Phẩm</a>
					<ul class="name">
						<!-- <li><a href="#">C</a>
							<ul class="topic">
								<li><a href="#">Tutorial</a></li>
								<li><a href="#">Program</a></li>
								<li><a href="#">Interview Q/A</a></li>
							</ul>
						</li> -->
						<?php
						$cate = $cat->show_category();
						if ($cate) {
							while ($result_new = $cate->fetch_assoc()) {	?>
								<li><a href="index.php?action=store&catid=<?php echo $result_new['catId'] ?>"><?php echo $result_new['catName'] ?></a></li>
						<?php }
						} ?>

					</ul>
				</li>

				<!-- <li><a href="#">Thương Hiệu</a>
					<ul class="name_brand">
						<?php
						$brand = $br->show_brand_home();
						if ($brand) {
							while ($result_new = $brand->fetch_assoc()) {		?>
								<li><a href="#"><?php echo $result_new['brandName'] ?></a></li>
						<?php }
						}
						?>
					</ul>
				</li> -->

				<li><a href="index.php?action=checkout">Thanh Toán</a></li>
				<li><a href="contact.php">Liên Hệ</a></li>
			</ul>
			<!-- /NAV -->
		</div>
		<!-- /responsive-nav -->
	</div>
	<!-- /container -->
</nav>
<!-- /NAVIGATION -->

<script>
</script>
<!-- <script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/slick.min.js"></script>
<script src="/js/nouislider.min.js"></script>
<script src="/js/jquery.zoom.min.js"></script>-->
<!-- <script type="text/javascript" src="js/jquery.min.js"></script>
<script src="/js/main.js"></script>  -->