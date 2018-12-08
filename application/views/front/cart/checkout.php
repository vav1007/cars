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
        <link rel="shortcut icon" href="images/favicon.png">
        <!-- <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"> -->
    <style>.error{color:red;font-weight:bold;}</style>
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
                            <li class="active">checkout</li>
                        </ol>
                    </div>
                    <div class="container-inner">
                        <!-- CONTAIN START -->
                        <section class="ptb-30 ptb-xs-20">
                            <div class="">
                                <div class="row">
                                   <div class="shop-main-area">
				<!-- coupon-area-area-start -->
				<div class="coupon-area">
					<div class="container" style="width:1068px;">
						<div class="row">
							<div class="col-lg-12">
								<div class="coupon-accordion">
									<h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
									<div class="coupon-content" id="checkout-login" style="display: none;">
										<div class="coupon-info">
											<p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est sit amet ipsum luctus.</p>
											<form action="#">
												<p class="form-row-first">
													<label>Username or email <span class="required">*</span></label>
													<input type="text">
												</p>
												<p class="form-row-last">
													<label>Password  <span class="required">*</span></label>
													<input type="text">
												</p>
												<p class="form-row">					
													<input type="submit" value="Login">
													<label>
														<input type="checkbox">
														 Remember me 
													</label>
												</p>
												<p class="lost-password">
													<a href="#">Lost your password?</a>
												</p>
											</form>
										</div>
									</div>
									<h3 class="hide">Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
									<div class="coupon-checkout-content hide" id="checkout_coupon" style="display: none;">
										<div class="coupon-info">
											<form action="#">
												<p class="checkout-coupon">
													<input type="text" placeholder="Coupon code">
													<input type="submit" value="Apply Coupon">
												</p>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- coupon-area-area-end -->
				<!-- checkout-area-start -->
				<div class="checkout-area">
				<?php 
				$user_sess_id=0;
				$user_sess_log_status =  $this->session->userdata('user_login_status');
				if($user_sess_log_status == 1)
				{
					$user_sess_id = $this->session->userdata(US_EXT.'userid'); 
					$user_sess_name = $this->session->userdata(US_EXT.'username'); 
				}
				?>
					<div class="container" style="width:1069px;">
						<div class="row">
						<form class="form-horizontal" role="form" action="" method="post" id="payment-form">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="checkbox-form">						
										<h3>Billing Details</h3>
										<div class="row">
											
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
												<div class="checkout-form-list">
													<label>User Name <span class="required">*</span></label>										
													<input class="form-control" id="shipping_name" name="shipping_name"
                                                            autocomplete="off" maxlength="60" type="text" placeholder="User name"/>
															<span class="error" id="shipping_name_error"></span>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
												<div class="checkout-form-list">
													<label>Email<span class="required">*</span></label>										
													<input class="form-control" id="shipping_email" name="shipping_email"
                                                            autocomplete="off" maxlength="60" type="text" placeholder="Email"/>
															<span class="error" id="shipping_email_error"></span>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
												<div class="checkout-form-list">
													<label>Mobile<span class="required">*</span></label>										
													<input class="form-control mobile_class" id="shipping_mobile" name="shipping_mobile"
                                                            autocomplete="off" maxlength="10" type="text" placeholder="Mobile number"/>
															<span class="error" id="shipping_mobile_error"></span>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
												<div class="checkout-form-list">
													<label>Address<span class="required">*</span></label>										
													<textarea class="form-control" id="shipping_address"
                                                           name="shipping_address" placeholder="Address" maxlength="200"></textarea>
														   <span class="error" id="shipping_address_error"></span>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
												<div class="checkout-form-list">
													<label>Land mark<span class="required">*</span></label>										
													<input class="form-control" id="shipping_landmark" name="shipping_landmark"
                                                            autocomplete="off" maxlength="60" type="text" placeholder="Land mark"/>
															<span class="error" id="shipping_landmark_error"></span>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
												<div class="checkout-form-list">
													<label>Area<span class="required">*</span></label>										
													<input class="form-control" id="shipping_area" name="shipping_area"
                                                            autocomplete="off" maxlength="60" type="text" placeholder="Area"/>
															<span class="error" id="shipping_area_error"></span>
												</div>
											</div>
											
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
												<div class="checkout-form-list">
													<label>City<span class="required">*</span></label>										
													<input class="form-control" id="shipping_city" name="shipping_city"
                                                            autocomplete="off" maxlength="60" type="text" placeholder="City"/>
															<span class="error" id="shipping_city_error"></span>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
												<div class="checkout-form-list">
													<label>State<span class="required">*</span></label>										
													<input class="form-control" id="shipping_state" name="shipping_state"
                                                            autocomplete="off" maxlength="60" type="text" placeholder="State"/>
															<span class="error" id="shipping_state_error"></span>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
												<div class="checkout-form-list">
													<label>Pincode<span class="required">*</span></label>										
													<input class="form-control number_class" id="shipping_pincode" name="shipping_pincode"
                                                            autocomplete="off" maxlength="6" type="text" placeholder="Pincode"/>
															<span class="error" id="shipping_pincode_error"></span>
												</div>
											</div>
											<!--Form ending here -->							
										</div>
										<div class="different-address">
												
											<div class="order-notes">
												<div class="checkout-form-list">
													<label>Order Notes</label>
													<textarea name="order_note" id="order_note" placeholder="Notes about your order. eg.Special notes for delivery." cols="30" rows="10"></textarea>
												</div>									
											</div>
										</div>													
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="your-order">
										<h3>Your order</h3>
										<div class="your-order-table table-responsive">
											<table>
												<thead>
													<tr>
														<th class="product-name">Product</th>
														<th class="product-total">Total</th>
													</tr>							
												</thead>
												<tbody>
												<?php
                                                $cartReq = json_decode($cart_details);
                                                if($cartReq->code == SUCCESS_CODE){
                                                    foreach($cartReq->cart_result as $cart_res){
                                                        $productLink = base_url().'details/'.url_title($cart_res->product_name).'/'.base64_encode($cart_res->product_id);
                                                        $productname = fetch_ucfirst($cart_res->product_name);
                                                
                                                ?>
													<tr class="cart_item">
														<td class="product-name">
														<?php echo $productname; ?> <strong class="product-quantity"> × <?php echo $cart_res->cart_qty; ?></strong>
														</td>
														<td class="product-total">
															<span class="amount"><i class="fa fa-inr"></i>&nbsp;<?php echo ($cart_res->sellingprice * $cart_res->cart_qty);  ?></span>
														</td>
													</tr>
													<?php } } ?>
												</tbody>
												<tfoot>
													<tr class="cart-subtotal">
														<th>Cart Subtotal</th>
														<td><span class="amount"><i class="fa fa-inr"></i>&nbsp;<?php echo ($cartReq->sub_total); ?></span></td>
													</tr>
													<tr class="shipping">
														<th>Shipping</th>
														<td>
															<ul>
																
																<li>
																	<input type="radio">
																	<label>Free Shipping:</label>
																</li>
																<li></li>
															</ul>
														</td>
													</tr>
													<tr class="order-total">
														<th>Order Total</th>
														<td><strong><span class="amount"><i class="fa fa-inr"></i>&nbsp;<?php echo ($cartReq->sub_total); ?></span></strong>
														</td>
													</tr>								
												</tfoot>
											</table>
										</div>
										
											
                                        <div style="text-align: left;"><br/>
                                            By submiting this order you are agreeing to our <a href="<?php echo base_url(); ?>terms-condition" target="_new">Terms & conditions</a>.
                                            If you have any questions about our products or services please contact us
                                            before placing this order.  
                                        </div>
										<div class="clearfix">&nbsp;</div>
										<div class="checkoutSubmitSection">
                                        <button type="submit" class="btn btn-success btn-lg pull-right submitBtnSection" >Pay
                                            Now
                                        </button>
										<div class="clearfix">&nbsp;</div>
                                        </div>
                                        <div class="checkoutHideSesction"></div>
										</div>
									</div>
								</div>
								<div class="clearfix">&nbsp;</div>
							</form>
						</div>
					</div>
				</div>
				<!-- checkout-area-end -->
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
        <script>
         /*>>checkout code start here*/
/*-------------------------
  showlogin toggle function
--------------------------*/
	 $( '#showlogin' ).on('click', function() {
        $( '#checkout-login' ).slideToggle(900);
     }); 
/*-------------------------
  showcoupon toggle function
--------------------------*/
	 $( '#showcoupon' ).on('click', function() {
        $( '#checkout_coupon' ).slideToggle(900);
     });
/*-------------------------
  Create an account toggle function
--------------------------*/
	 $( '#ship-box' ).on('click', function() {
        $( '#ship-box-info' ).slideToggle(1000);
     });            
/*>>checkout code end here*/
        </script>



    </body>
	<script type="text/javascript">
	$('#payment-form').on('submit',function(e){
        e.preventDefault();
        var str=true;
        var str=checkValidations();
        if(str==true)
        {
            var formdetails = JSON.stringify($('#payment-form').serializeObject());
            $('.checkoutSubmitSection').hide('');
            $('.checkoutHideSesction').html("<img style='height:100px' src='<?php echo LOOADING_IMAGE; ?>'>");

            $.ajax({
                    dataType: 'JSON',
                    method: 'post',
                    data:formdetails,
                    processData: false,
                    cache:false,
                    encType:false,
                    url: "<?php echo base_url(); ?>home/cart/insertOrder",
                    success: function (s) {
                    console.log(s)
                    if (s.code == 200)
                    {
                        var ordernumber = s.ordernumber;
                        $('.checkoutHideSesction').html(s.description).css({'color': 'green'});
                        setTimeout(function () {
                            window.location = "<?php echo base_url() ?>home/Cart/paymenttest/"+ordernumber;
                        }, 3000);
                    } else
                    {
                        $('.checkoutHideSesction').html(s.description).css({'color': 'red'});
                         $('.checkoutSubmitSection').show('');
                    }
                    },
                    error:function(e){console.log(e);}
            });
        }
       return str;
        
    });
	
	</script>
	<script type="text/javascript">
$('.number_class').on('keyup',function(){
    //(isNaN($(this).val()))?$(this).val(''):'';}
            var input = $(this);
            input.val(input.val().replace(/[^\d.]/g, ''));
            });
$('.mobile_class').on('keyup',function(){
	var mobile=$(this).val();
	(isNaN(mobile) && (mobile[0] > 6))?$(this).val(''):'';
	});
var namepattern = /^[a-zA-Z_., ]+$/;
var emailpattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
var passwordpattern=/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
var mobilepattern = /^[6-9]+[0-9]{9}$/;
var pincodepatteren = /^[1-9][0-9]{5}$/;
function email_check(inputdata) { if(inputdata==''){return false;} if(inputdata!='' && !emailpattern.test(inputdata)) { return false; }  }
function mobile_check(inputdata) { if(inputdata==''){return false;} if(inputdata!='' && !mobilepattern.test(inputdata)) { return false; }  }
function pincode_check(inputdata) { if(inputdata==''){return false;} if(inputdata!='' && !pincodepatteren.test(inputdata)) { return false; }  }
function empty_check(inputdata){ if(inputdata==''){return false;}  }
function checkValidations()
        {
            var str=true;
            $('#shipping_name_error,#shipping_email_error,#shipping_mobile_error,#shipping_address_error,#shipping_landmark_error,#shipping_area_error,#shipping_city_error,#shipping_pincode_error').text('');
	        $('#shipping_name,#shipping_email,#shipping_mobile,#shipping_address,#shipping_landmark,#shipping_area,#shipping_city,#shipping_state,#shipping_pincode').css('border','');
            $('#shipping_state').html('');
            var username=$('#shipping_name').val();
            var useremail=$('#shipping_email').val();
            var checkemail=email_check(useremail);
            var address=$('#shipping_address').val();
            var usermessage=$('#usermessage').val();
            var usermobile=$('#shipping_mobile').val();
            var checkmobile=mobile_check(usermobile);
            var pincode=$('#shipping_pincode').val();
            var checkpincode=pincode_check(pincode);

            var address = $('#shipping_address').val();
            var landmark = $('#shipping_landmark').val();
            var shipping_area = $('#shipping_area').val();
            var city = $('#shipping_city').val();
            var state = $('#shipping_state').val();

            if(username==''){$('#shipping_name_error').text('Please Enter Name');str=false;contactpending=false;}
            if(username!='' && !namepattern.test(username)){$('#shipping_name_error').text('Please Enter Valid Name');str=false;contactpending=false;}
            if(checkemail==false){$('#shipping_email_error').text('Please Enter  Email');str=false;contactpending=false;}
            if(checkmobile==false){$('#shipping_mobile_error').text('Please Valid Mobile Number');
             str=false; contactpending=false;}
             if(checkpincode==false){$('#shipping_pincode_error').text('Please enter 6 digit pincode');str=false; contactpending=false;}
             if(address==''){$('#shipping_address_error').text('Please Enter Address');str=false; contactpending=false;}
             if(landmark==''){$('#shipping_landmark_error').text('Please Enter Landmark');str=false; contactpending=false;}
             if(shipping_area==''){$('#shipping_area_error').text('Please Enter Area');str=false; contactpending=false;}
             if(city==''){$('#shipping_city_error').text('Please Enter City');str=false; contactpending=false;}
             if(state=='' || state=='0'){$('#shipping_state_error').text('Please Enter  State');str=false; contactpending=false;}
             
             return str;
        }

		$(document).ready(function(){
        var userid =  "<?php echo $user_sess_id;  ?>";
        if(userid != '0')
        {
            getUserDetails(userid);
        }
        
});
    function getUserDetails(s)
    {
        $.getJSON("<?php echo base_url(); ?>Userapi/getProfileDetails/"+s, function(r){
                console.log(r);
                if(r.code == 200)
                {
                    var userres = r.user_details;
                    $('#shipping_name').val(userres.username);
                    $('#shipping_email').val(userres.email);
                    $('#shipping_address').val(userres.address);
                    $('#shipping_mobile').val(userres.mobile);
                    $('#shipping_landmark').val(userres.landmark);
                    $('#shipping_area').val(userres.area);
                    $('#shipping_city').val(userres.city);
                    $('#shipping_pincode').val(userres.pincode);
                    
                }
        });
    }

</script>
</html>
