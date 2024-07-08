<div class="col-md-3"></div>

<div class="col-md-6">
	<!-- Billing Details -->
	<div class="billing-details padding60">
		<div class="section-title">
			<h3>Đổi mật khẩu mới tại đây</h3>
			<?php
				$err_login = Session::get('err');
			if(isset($err_login) && $err_login!='' ){
					$err = $err_login;
			// if((setcookie('err'))) $err = setcookie('err');
			if (isset($err['success'])) {
				echo $err['success'];
			} elseif (isset($err['fail'])) {
				echo $err['fail'];
			} else {
				echo $err['fail_str'];
			}
 			 Session::set('err', null);
		}
			// setcookie("err_pass", "", time() - 3600);
			?>
		</div>
		<?php
	
		?>
		<form action="handle.php" class="" method="POST">
			<!-- <div class="form-group">
								<input class="input" type="text" name="d" placeholder="Nhập email" required>
							</div> -->
			<div class="form-group">
				<input class="input" type="password" name="newpassword" placeholder="Mật khẩu mới" required>
			</div>
			<div class="form-group">
				<input class="input" type="password" name="re_password" placeholder="Nhập lại mật khẩu" required>
			</div>
			<button id="btn_login" type="submit" name="resetPass" class="primary-btn order-submit">Gửi yêu cầu</button>
		</form>
	</div>
	<!-- /Billing Details -->




</div>
<div class="col-md-3"></div>