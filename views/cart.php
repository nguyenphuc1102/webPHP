<!DOCTYPE html>
<html lang="zxx">

<head>
    <link type="text/css" rel="stylesheet" href="css/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style>
    #quantityCart{
        width: 80px;
    }

</style>
<body>



    <!-- ::::::  Start  Breadcrumb Section  ::::::  -->
    <div class="page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="page-breadcrumb__menu">
                        <li class="page-breadcrumb__nav"><a href="index.php?action=home">Home</a></li>
                        <li class="page-breadcrumb__nav active">Cart Page</li>
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
                        <h5 class="section-content__title">Your cart items</h5>
                    </div>
                    <!-- Start Cart Table -->
                    <div class="table-content table-responsive cart-table-content m-t-30">
                        <table>
                            <thead class="gray-bg">
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Until Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php


                                $list_cart = $ct->get_product_cart();
                                if ($list_cart) {
                                    $subtotal = 0;
                                    $qty = 0;
                                    while ($result = $list_cart->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="index.php?action=detail&proId=<?php echo $result['productId']?>"><img class="img-fluid" src="admin/uploads/<?php echo $result['image'] ?>" width="106px" height="69px" alt=""></a>
                                            </td>
                                            <td class="product-name"><a href="index.php?action=detail&proId=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a></td>
                                            <td class="product-price-cart"><span class="amount"><?php echo $fm->format_currency($result['price']) . " VNĐ" ?></span></td>
                                            <td class="product-quantities">
                                                <div class="quantity d-inline-block">
                                                    <form style=" display: flex;"  action="handleCart.php" method="POST">
                                                    <input id="quantityCart"  type="number" name="quantity" min="1"  value="<?php echo $result['quantity'] ?>">
                                                    <input type="hidden" name="cartId" min="0" value="<?php echo $result['cartId'] ?>"/>
                                                    <input type="hidden" name="proId" min="0" value="<?php echo $result['productId'] ?>"/>
                                                    <!-- <input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>"/> -->
                                                    <input type="submit" name="updateCart" value="Update"/>
                                                </form>
                                                </div>
                                             
                                            </td>
                                            <td class="product-subtotal">
                                                <?php
                                                $total = $result['price'] * $result['quantity'];
                                                echo $fm->format_currency($total) . " " . "VNĐ";
                                                ?>
                                            </td>
                                            <td class="product-remove">
                                                <a href="index.php?action=delete&cartId=<?php echo $result['cartId'] ?>"><i class="fa fa-pencil-alt"></i></a>
                                                <a onclick="return confirm('Bạn có muốn xóa không?');" href="index.php?action=cart&xuly=delete&cartId=<?php echo $result['cartId'] ?>"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                <?php
                                        $subtotal += $total;
                                        $qty = $qty + $result['quantity'];
                                    }
                                }

                                ?>
                            </tbody>
                        </table>

                        <table style="float:right;text-align:left;" width="40%" class="">
                            <tr>
                                <td> Total : </td>
                                <td><?php
                                    
                                        if ($list_cart) {
                                            echo $fm->format_currency($subtotal) . " " . "VNĐ";
                                            Session::set('sum', $subtotal);
                                            Session::set('qty', $qty);
                                        }
                                        else{
                                            Session::set('sum', '0 ');
                                            Session::set('qty', 0);
                                            
                                        }
                                    
                                    ?></td>
                            </tr>

                        </table>
                    </div> <!-- End Cart Table -->
                    <!-- Start Cart Table Button -->
                    <div class="cart-table-button m-t-10">
                        <div class="cart-table-button--left">

                            <a href="index.php?action=store" class=" btn--weight m-t-20">
                            <img src="img/shop.png" alt="">
                            </a>
                        </div>
                        <!-- <div class="cart-table-button--right">
                            <a href="index.php?action=" class=" btn--weight m-t-20 m-r-20">
                            <img src="img/check.png"  width="70%" alt="">
                            </a>
                            <a href="index.php?action=delete&cartId=" class="btn btn--box btn--large btn--blue btn--uppercase btn--weight m-t-20">Clear Shopping Cart</a>
                        </div>
                    </div> End Cart Table Button -->
                </div>

            </div>
            <div id="result"></div>
            <div class="row">


                <div class="col-lg-4 col-md-6">
                    <div class="sidebar__widget gray-bg m-t-40">
                        <div class="sidebar__box">
                            <h5 class="sidebar__title">Cart Total</h5>
                        </div>
                        <h6 class="total-cost"><label> Sub Total </label> 
                        <span><?php echo $fm->format_currency(Session::get('sum')) . " " . "VNĐ"; ?></span></h6>
                        <div class="total-shipping">
                            <!-- <span>Total shipping</span> -->
                            <ul class="shipping-cost m-t-10">
                                <li>
                                    <label for="ship-standard">
                                        <input type="radio" class="shipping-select" name="shipping-cost" value="Standard" id="ship-standard" checked><span>shipping</span>
                                    </label>
                                    <span class="ship-price"> <?php   $shipping=15000;
                                        echo $fm->format_currency($shipping) . " " . "VNĐ";  ?></span>
                                </li>
                                <li>
                                    <label for="ship-express">
                                        <input type="radio" class="shipping-select" name="shipping-cost" value="Express" id="ship-express"><span>Discount</span>
                                    </label>
                                    <span class="ship-price"><?php   $discount=0;
                                        echo $fm->format_currency($discount) . " " . "%";  ?></span>
                                </li>
                            </ul>
                        </div>
                        <h4 class="grand-total m-tb-25">Grand Total <span>
                            <?php if ($list_cart) { $subtotal =$subtotal - $subtotal*$discount + $shipping;
                            echo $fm->format_currency($subtotal) . " " . "VNĐ";}else echo "0 VNĐ    "  ?>
                            </span>
                        </h4>
                        <a href="index.php?action=checkout" class="btn btn--box btn--small btn--blue btn--uppercase btn--weight" >PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </main> <!-- ::::::  End  Main Container Section  ::::::  -->
    <!-- <link type="text/css" rel="stylesheet" href="css/style2.css" /> -->

  

    <!-- material-scrolltop button -->
    <button class="material-scrolltop" type="button"></button>
<!-- 
    <script>
        $(document).ready(function() {
            var action = 'search';
            $('#btn_login').click(function() {
                // var search_name = $('#search_name').value;
                <?php ?>;


                console.log(action);
                console.log(search_name);
            });
        });
        document.onclick(function() {
            console.log("dit ne");
        })
        var qt = document.getElementById('quantityCart');
        qt.addEventListener('change', function() {
            console(this.value);
        });
        $("#quantityCart").change(function() {
            value = this.value;
            console.log(value);
            console.log("value");
        });

        $(document).ready(function() {
            $("#quantityCart").change(function() {
                value = $this.value;
                console.log(value);
                console.log("value");
                search_name = "dkgiumf cái";
                $.ajax({
                    url: 'login_handle.php',
                    method: 'GET',
                    data: {
                        // action:action,
                        search_name: search_name
                    },
                    // success:
                }).done(function(data) {
                    $('#result').html(data);
                });

                // do your code here
                // When your element is already rendered
            });
        });
    </script> -->