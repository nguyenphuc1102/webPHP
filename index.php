<!DOCTYPE HTML>

<?php
// include_once 'lib/session.php';
// Session::init();
// ob_start();
?>
<?php


// include 'lib/database.php';
// include 'helpers/format.php';
// include 'function.php';
// include 'email/email.php';


// spl_autoload_register(function ($class) {
//   include_once "classes/" . $class . ".php";
// });


// $db = new Database();
// $fm = new Format();
// $ct = new cart();
// $us = new user();
// $br = new brand();
// $cat = new category();
// $cs = new customer();
// $product = new product();



?>

<body>
  <?php
  require_once("inc/header.php");
  //  $data = $product->getImageByProductId(23);
  //  print_r( $data);
  ?>
  <?php
  $login_check = Session::get('customer_login');
  $action = isset($_GET['action']) ? $_GET['action'] : "home";
  switch ($action) {
    case "home":
      require_once("views/slideshow.php");
      include("views/home.php");
      break;
    case 'cart':
      $act = isset($_GET['xuly']) ? $_GET['xuly'] : "list";
      $productid = isset($_GET['proId']) ? $_GET['proId'] : "";
      $cartid   = isset($_GET['cartId']) ? $_GET['cartId'] : "";
      switch ($act) {
        case 'list':
          require_once("views/cart.php");
          break;
        case 'update':
          break;
        case 'add':
          $addcard = $ct->add_to_cart(1, $productid);
          require_once("views/cart.php");
          header('Location:index.php?action=cart#dxd');
          break;
        case 'delete':
          $ct->del_product_cart($cartid);
          require_once("views/cart.php");
          // $controller_obj->delete_cart();
          break;
        case 'deleteall':
          break;
      }
      break;
    case "store":
      require_once("views/store.php");
      break;
    case "detail":
      $productid = isset($_GET['proId']) ? $_GET['proId'] : "";
			$data = $product->getImageByProductId($productid);
      require_once("views/product.php");

      break;
    case "logout":
      $logout = Session::destroyView();
      setcookie("email", "", time()-3600);
      setcookie("password", "", time()-3600);
      echo $logout;
      require_once("views/home.php");
      break;
    case "login":
      require_once("views/login.php");
      break;
    case "forgetpass":
      require_once("views/forgetPass.php");
      break;
    case "reset":
      require_once("views/resetPass.php");
      break;
    case "verification":
      require_once("views/verification.php");
      break;
    case "checkout":
      require_once("views/checkout.php");
      break;
    
    case "wishlist":
      require_once("views/wishlist.php");
      break;
    case "deleteWishlist":
      $customer_id = Session::get('customer_id');
      $proid = $_GET['proid'];
      $delwlist = $product->del_wlist($proid, $customer_id);
      require_once("views/wishlist.php");
      break;
    case "addwishlist":
      if (Session::get('customer_id')) {
        $productid = $_GET['proId'];
        $insertWishlist = $product->insertWishlist($productid, Session::get('customer_id'));
        header("location:index.php?action=wishlist") ;
        
      } else {
        header("location:index.php?action=login");
      }
      break;
  }

  ?>
  <?php
  require_once("inc/footer.php");
  ?>



  <!-- <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/slick.min.js"></script>
  <script src="js/nouislider.min.js"></script>
  <script src="js/jquery.zoom.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/main2.js"></script> -->
</body>

</html>