<?php
include_once 'lib/session.php';
Session::init();
?>
<?php
include 'lib/database.php';
include 'helpers/format.php';
include 'email/email.php';

spl_autoload_register(function ($class) {
  require_once "classes/" . $class . ".php";
});

?>
<?php
$mail = new Mailer();

$cs = new customer();

//login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  if (Session::get('customer_id')) {
    header('Location:index.php?action=home');
  } else {
    $login_Customers = $cs->login_customers($_POST);
    if (isset($_POST['remember'])) {
      setcookie('email', $_POST['email'], time() + 3600 * 24);
      setcookie('password', $_POST['password'], time() + 3600 * 24);
    }
    echo $login_Customers;
    // header('Location:index.php?action=login');
  }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['resgiter'])) {
  $login_Customers = $cs->insert_customers($_POST);
  echo $login_Customers;
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verification'])) { // verification
  if ($_POST['code'] !== $_SESSION['code']) {
    setcookie('fail_code', 'Mã xác nhận không hợp lệ', time() + 3600);
    header('Location:index.php?action=verification');
  } else {
    header('Location:index.php?action=reset');
  }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['resetPass'])) {
  $newpassword = $_POST['newpassword'];
  $re_password = $_POST['re_password'];

  if ($re_password === $newpassword) {
    // if (preg_match(
    //   "/^(?=(?:[^A-Z]*[A-Z]){2})(?=(?:[^0-9]*[0-9]){2}).{6,}$/",
    //   $re_password
    // )) {
    $err['success'] =  '<span style="color:green"> Đổi mật khẩu thành công</span> ';
    $email = session::get('mail');

    $result = $cs->forgetPass($email, $re_password);
    Session::set('mail', null);
    Session::set('code', null);
    echo $result;
    // if ($result) header('refresh:2;index.php?action=login');
    // header('Location:index.php?action=store');
    // } else {
    //   $err['fail_str'] = '<span style="color:red;">Mật khẩu của bạn cần phải dài ít nhất 6 kí tự. Mật khẩu có ít nhất 1 ký tự đặc biệt, chữ in hoa và số. </span>';
    //   header('Location:index.php?action=reset');
    // }
  } else {
    $err['fail'] = '<span style="color:red;">Mật khẩu không khớp. Vui lòng nhập lại</span>';
    header('Location:index.php?action=reset');
  }
  Session::set('err', $err);

  // setcookie('err', $err, time() + 3600);
} else {
  $act = isset($_GET['act']) ? $_GET['act'] : "";
  switch ($act) {
    case 'comment':
      $content = $_POST['content'];
      $productId = $_GET['proId'];
      $rate = $_POST['rating'];
      if (Session::get('customer_id') && Session::get('paid') === $productId) {
        $comment = $cs->insert_binhluan($content, $productId, Session::get('customer_id'), date("Y/m/d"), $rate);
        header('Location:index.php?action=detail&proId=' . $productId);
      } elseif (Session::get('customer_id') )  {
        $alert = "<script> window.location='index.php?action=detail&proId=$productId'; alert(\"Bạn cần mua sản phẩm này mới có thể bình luận\"); </script>";;
        echo $alert;
      
      }else{
        $alert = "<script> window.location='index.php?action=detail&proId=$productId'; alert(\"Bạn cần đăng nhập và mua sản phẩm này mới có thể bình luận\"); </script>";;
        echo $alert;
        // header('Location:index.php?action=detail&proId='.$productId);
      }
      break;
    case 'deleteComment':
      $productId = $_GET['proId'];

      $commentId = $_GET['id'];
      $deleteComment = $cs->del_comment($commentId);
      header('Location:index.php?action=detail&proId=' . $productId);
      break;
  }
}

?>