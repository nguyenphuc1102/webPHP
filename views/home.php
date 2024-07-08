<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Sản Phẩm Mới</h3>
                    <div class="section-nav">

                        <ul class="section-tab-nav tab-nav">
                            <?php
                            $get_slider = $product->show_slider();
                            if ($get_slider) {
                                $i = 0;
                                while ($result_slider = $get_slider->fetch_assoc()) {

                            ?>
                                    <li class="<?php if ($i === 0) {
                                                    echo 'active';
                                                }  ?>"><a  href="index.php?action=store">
                                                    <?php echo $result_slider['sliderName'] ?></a></li>
                            <?php
                                    $i++;
                                }
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /section title -->


            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                <!-- product -->
                                <?php
                                $product_new = $product->getNew_product();
                                if ($product_new) {
                                    while ($result_new = $product_new->fetch_assoc()) {

                                ?>
                                        <div class="product">
                                            <a href="index.php?action=detail&proId=<?php echo $result_new["productId"] ?>">

                                                <div class="product-img">
                                                    <img src="./admin/uploads/<?php echo $result_new["image"] ?>" width="336px" height="278px" alt="">
                                                    <div class="product-label">
                                                        <!-- <span class="sale">-30%</span> -->
                                                        <span class="new">NEW</span>
                                                    </div>
                                                </div>
                                            </a>

                                            <div class="product-body">
                                                <p class="product-category">Danh mục</p>
                                                <h3 class="product-name"><a href="#"><?php echo $result_new['productName'] ?></a></h3>
                                                <h4 class="product-price"><?php echo $fm->format_currency($result_new['price'])." "."VNĐ" ?>
                                                    <!-- <del class="product-old-price">$990.00</del>-->
                                                </h4>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="product-btns">
                                                    <a href="index.php?action=addwishlist&proId=<?php echo $result["productId"] ?>" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Thêm vào yêu thích</span></a>
                                                    <a class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></a>
                                                    <a class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Xem ngay</span></a>
                                                </div>
                                            </div>
                                            <div class="add-to-cart">
                                                <a href="index.php?action=cart&xuly=add&proId=<?php echo $result_new["productId"] ?>" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                                <!-- /product -->

                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>

                            <!-- <div id="slick-nav-1" class="products-slick-nav"></div> -->
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>


<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="hot-deal">
                    <ul class="hot-deal-countdown">
                        <li>
                            <div>
                                <h3>02</h3>
                                <span>Ngày</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>10</h3>
                                <span>Giờ</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>34</h3>
                                <span>Phút</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>60</h3>
                                <span>Secs</span>
                            </div>
                        </li>
                    </ul>
                    <h2 class="text-uppercase">Giá hot cuối tuần</h2>
                    <p>Bộ sưu tập giảm giá tới 50%</p>
                    <a class="primary-btn cta-btn" href="index.php?action=store">Mua ngay</a>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->


<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Sản Phẩm Nổi Bật</h3>
                    <div class="section-nav">

                        <ul class="section-tab-nav tab-nav">
                            <?php
                            $get_slider = $product->show_slider();
                            if ($get_slider) {
                                $i = 0;
                                while ($result_slider = $get_slider->fetch_assoc()) {

                            ?>
                                    <li class="<?php if ($i === 0) {
                                                    echo 'active';
                                                }  ?>"><a  href="index.php?action=store"><?php echo $result_slider['sliderName'] ?></a></li>
                            <?php
                                    $i++;
                                }
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-2">
                                <?php
                                $product_feathered = $product->getproduct_feathered();
                                if ($product_feathered) {
                                    $i = 0;
                                    while ($result = $product_feathered->fetch_assoc()) {


                                ?>
                                        <!-- product -->
                                        <div class="product">
                                        <a href="index.php?action=detail&proId=<?php echo $result["productId"] ?>">
                                            <div class="product-img">

                                                <img src="./admin/uploads/<?php echo $result['image'] ?>" width="336px" height="278px" alt="">
                                                <div class="product-label">
                                                    <!-- <span class="sale">-30%</span> -->
                                                    <span class="new">HOT</span>
                                                </div>
                                            </div>
                                        </a>
                                            <div class="product-body">
                                                <p class="product-category">Danh mục</p>
                                                <h3 class="product-name"><a href="#"><?php echo $result['productName'] ?></a></h3>
                                                <h4 class="product-price"><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></h4>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="product-btns">
                                                    <a href="index.php?action=addwishlist&proId=<?php echo $result["productId"] ?>" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Thêm vào yêu thích</span></a>
                                                    <a class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></a>
                                                    <a class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Xem ngay</span></a>
                                                </div>
                                            </div>
                                            <div class="add-to-cart">
                                                <a href="index.php?action=cart&xuly=add&proId=<?php echo $result["productId"] ?>" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
                                            </div>
                                        </div>
                                        <!-- /product -->

                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div id="slick-nav-2" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <?php for ($i = 1; $i <= 3; $i++) { ?>
                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Hàng bán chạy</h4>
                        <div class="section-nav">
                            <div id="slick-nav-<?php echo $i+4 ?>" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-<?php echo $i+4 ?>">
                        <div>
                            <!-- product widget -->
                            <?php
                            $product_feathered = $product->getproduct_topSelling($i, 3);
                            if ($product_feathered) {

                                while ($result = $product_feathered->fetch_assoc()) {


                            ?>
                                    <div class="product-widget">
                                    <a href="index.php?action=detail&proId=<?php echo $result["productId"] ?>">
                                        <div class="product-img">
                                            <img src="./admin/uploads/<?php echo $result['image'] ?>" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Danh mục</p>
                                            <h3 class="product-name"><a href="index.php?action=detail&proId=<?php echo $result["productId"] ?>"><?php echo $result['productName'] ?></a></h3>
                                            <h4 class="product-price"><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></h4>
                                        </div>
                                    </a>
                                        </div>
                                <?php
                                }
                            } ?>

                        </div>

                        <div>
                            <!-- product widget -->
                            <?php
                            $product_feathered = $product->getproduct_topSelling($i-1, 3);
                            if ($product_feathered) {

                                while ($result = $product_feathered->fetch_assoc()) {


                            ?>
                                    <div class="product-widget">
                                    <a href="index.php?action=detail&proId=<?php echo $result["productId"] ?>">

                                        <div class="product-img">
                                            <img src="./admin/uploads/<?php echo $result['image'] ?>" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Danh mục</p>
                                            <h3 class="product-name"><a href="index.php?action=detail&proId=<?php echo $result["productId"] ?>"><?php echo $result['productName'] ?></a></h3>
                                            <h4 class="product-price"><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></h4>
                                        </div>
                                    </a>
                                    </div>
                            <?php
                                }
                            } ?>

                            <!-- /product widget -->
                        </div>
                    </div>
                </div>
            <?php } ?>



        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- NEWSLETTER -->
<!-- <script type="text/javascript" src="js/jquery.min.js">
</script> -->