<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <!-- Basic Page Needs
          ================================================== -->
        <meta charset="utf-8">
        <title><?php echo PROJECT_NAME; ?></title>
        <!-- SEO Meta
          ================================================== -->
          <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="<?php  echo META_DESCRIPTION; ?>">
        <meta name="keywords" content="<?php  echo META_KEYWORDS; ?>">
        <meta name="distribution" content="global">
        <meta name="revisit-after" content="2 Days">
        <meta name="robots" content="ALL">
        <meta name="rating" content="8 YEARS">
        <meta name="Language" content="en-us">
        <meta name="GOOGLEBOT" content="NOARCHIVE">
        <!-- Mobile Specific Metas
          ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS
          ================================================== -->
        <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;  ?>font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;  ?>bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;  ?>jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;  ?>owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;  ?>fotorama.css">
        <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;  ?>magnific-popup.css">
        <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;  ?>custom.css">
        <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;  ?>responsive.css">
        <link rel="shortcut icon" href="<?php echo FRONT_IMAGES_PATH;  ?>favicon.png">
        <!-- <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"> -->
    </head>
    <body>

        <div class="main"> 
            <div class="container">
                <div class="mian-contain">

                    <!-- HEADER START -->
                    <?php $this->load->view(FRONT_HEADER_PATH); ?>
                    <!-- HEADER END -->


                    <div class="container">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="active">cart</li>
                        </ol>
                    </div>
                    <div class="container-inner">
                        <!-- CONTAIN START -->
                        <section class="ptb-30 ptb-xs-20">
                            <div class="">
                                <div class="row">
                                    		
                                    <div class="col-md-12">
                                        <form action="#">
									<div class="table-content table-responsive">
										<table>
											<thead>
												<tr>
													<th class="product-thumbnail">Image</th>
													<th class="product-name">Product</th>
													<th class="product-price">Price</th>
													<th class="product-quantity">Quantity</th>
													<th class="product-subtotal">Total</th>
													<th class="product-remove">Remove</th>
												</tr>
											</thead>
											<tbody>
                                                <?php
                                                $cartReq = json_decode($cart_details);
                                                if($cartReq->code == SUCCESS_CODE){
                                                    foreach($cartReq->cart_result as $cart_res){
                                                        $productLink = base_url().'details/'.url_title($cart_res->product_name).'/'.base64_encode($cart_res->product_id);
                                                        $productname = fetch_ucfirst($cart_res->product_name);
                                                print_r($cart_res);
                                                $cartid = $cart_res->id;
                                                ?>
                                                <tr>
													<td class="product-thumbnail"><a href="<?php echo $productLink; ?>"><img src="<?php echo $cart_res->product_pic;  ?>" alt="<?php ?>"></a></td>
													<td class="product-name"><a href="<?php echo $productLink; ?>"><?php echo $productname; ?></a></td>
													<td class="product-price"><span class="amount<?php echo $cartid; ?>"><?php echo $cart_res->sellingprice;  ?></span></td>
													<td class="product-quantity"><input  class="number_class" onkeyup="return updateQty(event,'<?php echo $cartid; ?>')"  type="text" id="cart_qty<?php echo $cartid; ?>" value="<?php echo $cart_res->cart_qty; ?>"></td>
													<td class="mainSubTotal product-subtotal<?php echo $cartid; ?>"><?php echo ($cart_res->sellingprice * $cart_res->cart_qty);  ?></td>
													<td class="product-remove"><a href="javascript:void(0)" onclick="removeCartItem(<?php echo $cart_res->id;  ?>)"><i class="fa fa-times"></i></a></td>
												</tr>
                                                <?php } } else {?>
                                                <td colspan="6"><div class="alert alert-danger text-center">No items found in cart.</div></td>
                                                <?php } ?>
											</tbody>
										</table>
                                        <div class="">
                                        <div class="coupon col-md-5">
                                            <h3>Coupon</h3>
                                            <p>Enter your coupon code if you have one.</p>
                                            
                                                <input type="text" id="couponcode" placeholder="Coupon code">
                                               
                                                <a href="javascript:void(0);" onclick="applyCoupon()" >Apply Coupon</a>
                                                <br/><span class="error" id="couponcode_error"></span>
								        </div>
                                        <a class="pull-right btn btn-warning" href="<?php echo base_url(); ?>">continue shopping</a>
                                        </div>
									</div>
								</form>
                                    </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="float:right;">
								<div class="cart_totals">
									<h2>Cart Totals</h2>
									<table>
										<tbody>
											<tr class="cart-subtotal">
												<th>Subtotal</th>
												<td>
													<span class="amount"><?php echo $cartReq->sub_total; ?></span>
												</td>
											</tr>
											<tr class="shipping ">
												<th>Shipping</th>
												<td>
													<ul id="shipping_method">
														<li>
															<label> Free Shipping </label>
														</li>
													</ul>
													
												</td>
											</tr>
                                            <tr class="cart-subtotal">
												<th>Discount</th>
												<td>
                                                <?php
                                                //pending
                                                $discount= $this->session->userdata(''); ?>
													<span class="amount">0</span>
												</td>
											</tr>
											<tr class="order-total">
												<th>Total</th>
												<td>
													<strong>
														<span class="amount"><i class="fa fa-inr"></i>&nbsp;<?php echo $cartReq->sub_total;?></span>
													</strong>
												</td>
											</tr>
										</tbody>
									</table>
                                    <?php if($cartReq->code == SUCCESS_CODE){ ?>
									<div class="wc-proceed-to-checkout">
										<a href="<?php echo base_url(); ?>checkout"><i class="fa fa-angle-double-right"></i>Proceed to Checkout</a>
									</div>
                                    <?php } ?>
								</div>
							</div>
                                </div>
                            </div>
                        </section>
                        <!-- CONTAINER END --> 

                        <!-- CONTAIN START -->



                        <!-- CONTAINER END -->  
                    </div>

                    <!-- FOOTER START -->
                    <?php $this->load->view(FRONT_FOOTER_PATH); ?>
                    <!-- FOOTER END -->
                </div>
            </div>
        </div>
        <script src="<?php echo FRONT_JS_PATH;  ?>fotorama.js"></script>
        <script src="<?php echo FRONT_JS_PATH;  ?>jquery.magnific-popup.js"></script>  
        <script src="<?php echo FRONT_JS_PATH;  ?>owl.carousel.min.js"></script> 
        <script src="<?php echo FRONT_JS_PATH;  ?>custom.js"></script>
<!-- <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> -->


<script type="text/javascript">
function applyCoupon()
{
    let str=true;
    $('#couponcode_error').html('');
    let couponcode=$('#couponcode').val();
    if(couponcode==''){$('#couponcode_error').html('Please enter coupon code').css({'color':'red'}); str=false;}
    if(str==true)
    {
        $.ajax({    
                dataType: 'JSON',
                type: 'post',
                data:{'couponcode':couponcode},
                url: "<?php echo base_url(); ?>getcoupondetails",
                success: function (s) { console.log(s); 
                    $('#couponcode_error').html(s.description);
                        if(s.code==200){
                            
                        }
                        setCartTotal();

                },
                error:function(e){console.log(e);}
            });
    }
    return str;
}
function updateQty(evt,id)
{
         let str='';
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
         {
            str=false;
         }
         else
         {  
             str=true;
         }

        if(str==true)
        {
            let updateqty=$('#cart_qty'+id).val();
            if(updateqty==0)
            {   
                removeCartItem(id);
            }
            else
            {
                let price=$('.amount'+id).html();
                let setprice = (parseFloat(price) * parseInt(updateqty));
                $.ajax({    
                            dataType: 'JSON',
                            type: 'post',
                            data:{'qty':updateqty,'cartid':id},
                            url: "<?php echo base_url(); ?>updatecartqty",
                            success: function (s) { console.log(s); 
                                    if(s.code==200){
                                        $('.product-subtotal'+id).html(setprice);
                                    }
                                    setCartTotal();

                            },
                            error:function(e){console.log(e);}
                        });
            }
        }
        return str;

         
} 

function setCartTotal()
{
    alert('success');
}
</script>

    </body>
</html>
