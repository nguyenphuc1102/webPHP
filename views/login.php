
<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Đăng Nhập</h3>
						<ul class="breadcrumb-tree">
							<li><a href="index?action=home">Home</a></li>
							<li class="active">Đăng Nhập</li>
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

					<div class="col-md-6">
						<!-- Billing Details -->
						<div class="billing-details padding60">
							<div class="section-title">
								<h3 class="title">KHÁCH HÀNG ĐÃ ĐĂNG KÝ</h3>
							</div>
							<?php 
							  if (isset($_COOKIE['err_login']))
							  {
							  echo $_COOKIE['err_login'];
							  setcookie("err_login", "", time()-3600);
							  }
							 ?>
					
                            <form action="handle.php" class="" method="POST">
							<div class="form-group">
								<input class="input" type="text" name="email" value="<?php 
									if (isset($_COOKIE['email'])){
									echo $_COOKIE['email'];
									} ?>" placeholder="Tài Khoản" required>
							</div>
							<div class="form-group">
								<input class="input" type="password" name="password" value="<?php 
									if (isset($_COOKIE['password'])){
									echo $_COOKIE['password'];
									} ?>" placeholder="Mật khẩu" required>
							</div>
							<div class="form-group">
                                <label style="font-weight:500; min-height: 20px; margin-bottom: 5px;  cursor: pointer;">
								
                                Nếu bạn quên mật khẩu click <a href="index.php?action=forgetpass" style="font-weight: 700; " > tại đây </a>
							    </label>

							</div>
							
							<div class="form-group">
								<div class="input-checkbox">
									<input name="remember" type="checkbox" id="create-account">
									<label for="create-account">
										<span></span>
										Nhớ mật khẩu
									</label>
								
								</div>
							</div>
                            <button id="btn_login" type="submit" name="login" class="primary-btn order-submit">Đăng Nhập</button>
                            </form>
						</div>
						<!-- /Billing Details -->



					
					</div>

					<!-- Order Details -->
					<div class="col-md-6 order-details">
						<div class="section-title text-center padding60">
							<h3 class="title">KHÁCH HÀNG CHƯA ĐĂNG KÝ</h3>
						</div>
						<!-- <div class="form-group">
								<input class="input" type="text" name="firstname" placeholder="Họ">
							</div> -->
							<?php 
								  if (isset($_COOKIE['err_resgiter']))
								  {
								  echo $_COOKIE['err_resgiter'];
								  setcookie("err_resgiter", "", time()-3600);
								  }
							?>
                            <form action="handle.php" class="" method="POST">
							
								<div class="form-group">
									<input class="input" type="text" name="name" required placeholder="Tên">
								</div>
					
								<div class="form-group">
									<input class="input" type="email" name="email" required placeholder="Địa chỉ email">
								</div>
								<div class="form-group">
									<input class="input" type="text" name="phone" required placeholder="SDT ">
								</div>
								<div class="form-group">
									<input class="input" type="text" name="address" required placeholder="Địa chỉ">
								</div>
								<div class="form-group">
									<input class="input" type="text" name="zipcode"  placeholder="Zipcode">
								</div>
								<div class="form-group">
									<input class="input" type="password" name="password" required placeholder="Mật khẩu">
								</div>
								<!-- <div class="form-group">
									<input class="input" type="password" name="password" placeholder="Xác nhận lại mật khẩu">
								</div> -->
					
								<div class="form-group">
                                </div>
                                <button type="submit" name="resgiter" class="primary-btn order-submit">Đăng Nhập</button>
						<!-- <a href="#" class="primary-btn order-submit">Đăng ký</a> -->
							</form>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		<script>
	// 		 $(document).ready(function(){
    //     var action='search';
    //     $('#btn_login').click(function(){
    //         // var search_name = $('#search_name').value;
    //        <?php ?>;
    //             $.ajax({
    //             url:'backend-search.php',
    //             method:'POST',
    //             data:{
    //                 action:action,
    //                 search_name: search_name
    //             },
    //             // success:
    //         }).done(function(data){
    //                 $('#result').html(data);
    //             });
        
    //         console.log(action);
    //         console.log(search_name);
    //     });
    // });
		</script>