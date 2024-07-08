<div class="col-md-3"></div>

<div class="col-md-6">
						<!-- Billing Details -->
						<div class="billing-details padding60">
							<div class="section-title">
								<h3 class="title">Nhập Email</h3>
							</div>
							<?php 
							// $err = Session::get('mail');
							if (isset($_COOKIE['mail']))
								{
								echo $_COOKIE['mail'];
								}	
								setcookie("mail", "", time()-3600);
							?>
                            <form action="login_handle.php" class="" method="POST">
							<div class="form-group">
								<input class="input" type="text" name="email_forget" placeholder="Nhập email" required>
							</div>
							<!-- <div class="form-group">
								<input class="input" type="password" name="password" placeholder="Mật khẩu" required>
							</div> -->
                            <button id="btn_login" type="submit" name="forget" class="primary-btn order-submit">Gửi yêu cầu</button>
                            </form>
						</div>
						<!-- /Billing Details -->



					
					</div>
<div class="col-md-3"></div>
