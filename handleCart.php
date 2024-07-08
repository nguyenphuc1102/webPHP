
<?php
include 'lib/database.php';
include 'helpers/format.php';
include 'email/email.php';
// Session::init();

spl_autoload_register(function ($class) {
    require_once "classes/" . $class . ".php";
});
$ct = new Cart();
// $mail = new Mailer();
?>
<?php       
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateCart'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $cartId = $_POST['cartId'];
        $proId = $_POST['proId'];
        $quantity = $_POST['quantity'];
        // echo $cartId;
        // echo $quantity;

        $update_quantity_Cart = $ct->update_quantity_Cart($quantity, $cartId); // hàm check catName khi submit lên
        if($update_quantity_Cart){
            Session::set('qty',$quantity);
            header('location:index.php?action=cart#dxd');
        }
    	// if ($quantity <= 0) {
    	// 	$delcart = $ct->del_product_cart($cartId);
    	// }
    } else {
        echo "k đk  ";
    }
 ?>