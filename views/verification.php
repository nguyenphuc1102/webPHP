<div class="col-md-3"></div>

<div class="col-md-6">
    <!-- Billing Details -->
    <div class="billing-details padding60">
        <div class="section-title">
            <h3 class="title">Nhập mã xác nhận</h3>
        </div>
        <?php
        if (isset($_COOKIE['fail_code']))
        {
        echo $_COOKIE['fail_code'];
        setcookie("fail_code", "", time()-3600);
        }
         ?>
        <form action="handle.php" class="" method="POST">
            <div class="form-group">
                <input class="input" type="text" name="code" placeholder="Nhập mã" required>
            </div>
            <!-- <div class="form-group">
								<input class="input" type="password" name="password" placeholder="Mật khẩu" required>
							</div> -->
            <button id="" type="submit" name="verification" class="primary-btn order-submit">Gửi yêu cầu</button>
        </form>
    </div>
    <!-- /Billing Details -->




</div>
<div class="col-md-3"></div>