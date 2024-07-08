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

$mail = new Mailer();
$us = new user();
$cs = new customer();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['forget'])) {
  $email = $_POST['email_forget'];
  if ($email == '') {
  } else if (!empty($email)) {
    $result = $cs->getUserEmail($email);
    if ($result) {
      $name = $row['name'];
      $code = substr(rand(0, 999999), 0, 6);
      $title = 'Quên mật khẩu. Thiết lập lại mật khẩu đăng nhập';
      $content = "Xin chào .$name.,
      Chúng tôi nhận được yêu cầu thiết lập lại mật khẩu cho tài khoản của bạn.<br>
      <p>Mã xác nhận của bạn là: <b><span>" . $code . "</span></b> </p>";
      $mail->sendEmail($title, $content, $email);
      Session::set('mail', $email);
      Session::set('code', $code);
      header('Location:index.php?action=verification');
    } else {
      setcookie('mail', '<span style="color:red;">Email không tồn tại</span>', time() + 3600);
      // Session::set('mail', '');
      header('Location:index.php?action=forgetpass');
    }
  }
}
?>