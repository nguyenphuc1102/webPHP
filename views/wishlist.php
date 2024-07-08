<!DOCTYPE html>
<html lang="zxx">
    <head>
    <link type="text/css" rel="stylesheet" href="css/main.css" />
    </head>
<body>
   <!-- ::::::  Start  Breadcrumb Section  ::::::  -->
    <div class="page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="page-breadcrumb__menu">
                        <li class="page-breadcrumb__nav"><a href="#">Home</a></li>
                        <li class="page-breadcrumb__nav active">Wishlist Page</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- ::::::  End  Breadcrumb Section  ::::::  -->

    <!-- ::::::  Start  Main Container Section  ::::::  -->
    <main id="main-container" class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-content">
                        <h5 class="section-content__title">Yêu Thích</h5>
                    </div>
                    <!-- Start Cart Table -->
                    <div class="table-content table-responsive cart-table-content m-t-30">
                        <table>
                            <thead class="gray-bg" >
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Hành động</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php 
							$customer_id = Session::get('customer_id');
							$get_wishlist = $product->get_wishlist($customer_id);
							if($get_wishlist){
                                $subtotal = 0;
                                    $qty = 0;
								while ($result = $get_wishlist->fetch_assoc()) {
							
								
							 ?>
                              <tr>
                                            <td class="product-thumbnail">
                                                <a href="index.php?action=detail&proId=<?php echo $result['productId'] ?>"><img class="img-fluid" src="admin/uploads/<?php echo $result['image'] ?>" width="106px" height="69px" alt=""></a>
                                            </td>
                                            <td class="product-name"><a href="index.php?action=detail&proId=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a></td>
                                            <td class="product-price-cart"><span class="amount"><?php echo $fm->format_currency($result['price']) . " VNĐ" ?></span></td>
                                            <td class="product-remove">
                                                <a href="index.php?action=deleteWishlist&proid=<?php echo $result['productId'] ?>"><i class="fa fa-pencil-alt"></i></a>
                                                <a onclick="return confirm('Bạn có muốn xóa không?');" href="index.php?action=deleteWishlist&proid=<?php echo $result['productId'] ?>"><i class="fa fa-times"></i></a>
                                            </td>
                                            <td >
                                                <a href="index.php?action=deleteWishlist&proid=<?php echo $result['productId'] ?>"></a>
                                                <a href="index.php?action=cart&xuly=add&proId=<?php echo $result['productId'] ?> ">Mua ngay</a>
                                                <!-- <a onclick="return confirm('Bạn có muốn xóa không?');" href="index.php?action=Id=<?php echo $result['id'] ?>"><i class="fa fa-times"></i></a> -->
                                            </td>
                                        </tr>
                                        <?php 
                                        // $qty+=$result['quantity'];
                                }
                                }
                                ?>
                            
                            </tbody>
                        </table>
                    </div>  <!-- End Cart Table -->
                     <!-- Start Cart Table Button -->
                    <!-- <div class="cart-table-button m-t-10">
                        <div class="cart-table-button--left">
                            <a href="#" class="btn btn--box btn--large btn--gray btn--uppercase btn--weight m-t-20">CONTINUE SHOPPING</a>
                        </div>
                        <div class="cart-table-button--right">
                            <a href="#" class="btn btn--box btn--large btn--gray btn--uppercase btn--weight m-t-20 m-r-20">UPDATE SHOPPING CART</a>
                            <a href="#" class="btn btn--box btn--large btn--blue btn--uppercase btn--weight m-t-20">Clear Shopping Cart</a>
                        </div>
                    </div> -->
                      <!-- End Cart Table Button -->
                </div>
                
            </div>
      
        </div>
    </main> <!-- ::::::  End  Main Container Section  ::::::  -->
<script>
// function loadDynamicContentModal(modal){
// 	var options = {
// 			modal: true,
// 			height:300,
// 			width:500
// 		};

// 	$('#demo-modal').html("<div class='modal-content'><div class='modal-body'> <p>Some text in the Modal Body</p> <p>Some other text...</p>  </div></div>");
// 	$('#demo-modal').load('get-dynamic-content.php?modal='+modal).dialog(options).dialog('open');
// }
//     $('demo-modal-target').onclick(function(){
//     $.ajax({
//         type: "POST",
//         url: "",
//         data: {
//             'apiName': 'ok',
        
//         },
//         success: function(msg)
//         {
//             $("#getCode").html(msg);
//             $("#getCodeModal").modal("toggle");
//         }
//     });
// });
</script>
   <?php
	// $dynamic_content_array = array(
	// 		"jquery" => "<img src='jquery-logo.jpg' /><div class='modal-text'>jQuery is a Javascript library provides API functions for handling events with animation effects.</div>",
	// 		"bootstrap" => "<img src='bootstrap-logo.jpg' /><div class='modal-text'>Bootstrap is a popular framework helps in fast and furious web developement.</div>",
	// 		"responsive" => "<img src='responsive.jpg' /><div class='modal-text'>Web design methodology used to make the page content responsive to the size of various viewport.</div>"
	// );
	
	// if(!empty($_GET["modal"])) {
	// 	print $dynamic_content_array[$_GET["modal"]];
	// }
?>
    



<!-- </html> -->
