<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->
					<?php
						$get_slider = $product->show_slider();
						if($get_slider){
							while($result_slider = $get_slider->fetch_assoc()){

						 ?>
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="./admin/uploads/<?php echo $result_slider['slider_image'] ?>" alt="">
							</div>
							<div class="shop-body">
								<h3>Bộ sưu tập <br> <?php echo $result_slider['sliderName'] ?></h3>
								<a href="index.php?action=store" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<?php 
							}}
					?>
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>