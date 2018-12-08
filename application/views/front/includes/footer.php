<!-- FOOTER START -->
<div class="footer">
        <div class="footer-inner">
          <div class="footer-middle dark-bg">
            <div class="container-inner">
              <div class="row">
                <div class="col-md-4 f-col">
                 <div class="footer-static-block"> <span class="opener plus"></span>
                    <div class="f-logo"> 
                      <a href="index.html" class=""> <img src="<?php echo LOGO_PATH; ?>" alt="Logo"> </a>
                    </div>
                    <div class="footer-block-contant">
                       <p>Lorem khaled ipsum is a major key to success. It�s on you how you want to live your life. Everyone has a choice. I pick my choice, squeaky clean. Always remember in the jungle there�s a lot of they in there, after you overcome.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                <div class="row">
                  <div class="col-md-4 f-col">
                   <div class="footer-static-block"> <span class="opener plus"></span>
                    <h3 class="title">Information</h3>
                    <ul class="footer-block-contant link">
                      <li><a href="<?php echo base_url(); ?>aboutus">About</a></li>
                      <li><a href="<?php echo base_url(); ?>contactus">Contact Us</a></li>
                      <li ><a href="<?php echo base_url(); ?>blog">Blog</a></li>
                      <li><a href="<?php echo base_url(); ?>affiliates">Affiliates</a></li>
                      <li><a href="<?php echo base_url(); ?>careers">Career</a></li>
                      <li><a href="<?php echo base_url(); ?>faqs">FAQ?</a></li>
                    </ul>
                  </div>
                  </div>
                  <div class="col-md-4 f-col">
                    <div class="footer-static-block"> <span class="opener plus"></span>
                      <h3 class="title">Customer care</h3>
                      <ul class="footer-block-contant link">
                        <li><a href="<?php echo base_url(); ?>profile">My Account</a></li>
                        <li><a>Order Tracking</a></li>
                        <li><a  href="<?php echo base_url(); ?>wishlist">Wishlist</a></li>
                        <li><a href="<?php echo base_url(); ?>contactus">Support</a></li>
                        <li><a>Customer Services</a></li>
                        <li><a>Exchange</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-4 f-col">
                   <div class="footer-static-block"> <span class="opener plus"></span>
                      <h3 class="title">Address</h3>
                      <ul class="footer-block-contant address-footer">
                        <li class="item"> <i class="fa fa-home"> </i>
                          <p><?php echo PROJECT_ADDRESS; ?></p>
                        </li>
                        <li class="item"> <i class="fa fa-envelope"> </i>
                          <p> <a><?php echo PROJECT_EMAIL; ?></a> </p>
                        </li>
                        <li class="item"> <i class="fa fa-phone"> </i>
                          <a href="tel:+<?php echo PROJECT_PHONE; ?>"><?php echo PROJECT_PHONE; ?></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>
          <div class="footer-bottom">
            <div class="container-inner">
              <div class="row">
                <div class="col-sm-4">
                  <div class="footer_social pt-xs-15 center-xs mt-xs-15">
                    <ul class="social-icon">
                      <li><a title="Facebook" class="facebook"><i class="fa fa-facebook"> </i></a></li>
                      <li><a title="Twitter" class="twitter"><i class="fa fa-twitter"> </i></a></li>
                      <li><a title="Linkedin" class="linkedin"><i class="fa fa-linkedin"> </i></a></li>
                      <li><a title="RSS" class="rss"><i class="fa fa-rss"> </i></a></li>
                      <li><a title="Pinterest" class="pinterest"><i class="fa fa-pinterest"> </i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="copy-right center-sm">&copy; 2018 <?php echo DEVELOPED_BY;  ?> All Rights Reserved.</div>
                </div>
                <div class="col-sm-4">
                  <div class="payment right-side float-none-xs center-xs">
                    <ul class="payment_icon">
                      <li class="discover"><a></a></li>
                      <li class="visa"><a></a></li>
                      <li class="mastro"><a></a></li>
                      <li class="paypal"><a></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="scroll-top">
        <div id="scrollup"></div>
      </div>
      <!-- FOOTER END -->
      <script src="<?php echo FRONT_JS_PATH;  ?>jquery-1.12.3.min.js"></script> 
        <script src="<?php echo FRONT_JS_PATH;  ?>bootstrap.min.js"></script> 
        <script src="<?php echo FRONT_JS_PATH;  ?>jquery-ui.min.js"></script> 
        <script src="<?php echo FRONT_JS_PATH;  ?>project.js"></script> 
        <script type="text/javascript">
        $.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
        function addToWishlist(productid)
        {
          $.ajax({
                dataType: 'JSON',
                type: 'post',
                data:{'productid':productid},
                url: "<?php echo base_url(); ?>addtowishlist",
                success: function (s) { console.log(s); alert(s.description);
                    if(s.code == 200)
                    {
                       
                    }
                },
                error:function(e){console.log(e);}
            });
        }

        function addToCompare(productid)
        {
              $.ajax({
                dataType: 'JSON',
                type: 'post',
                data:{'productid':productid},
                url: "<?php echo base_url(); ?>addtocompare",
                success: function (s) { console.log(s); alert(s.description);
                    if(s.code == 200)
                    {
                       
                    }
                },
                error:function(e){console.log(e);}
            });
        }

     
     function addToCart(productid)
        {
          var cart_qty = $("#cart_qty").val();
          
              $.ajax({
                dataType: 'JSON',
                type: 'post',
                data:{'qty':cart_qty,'productid':productid},
                url: "<?php echo base_url(); ?>addtocart",
                success: function (s) { console.log(s); alert(s.description);
                    if(s.code == 200)
                    {
                       window.location=location.href;
                    }
                    $('.cart_subtotal').html(s.sub_total);
                },
                error:function(e){console.log(e);}
            });
        }
    
    function removeCartItem(cartid)
    {
      if(confirm('confirm to remove item ??')==true)
      {
        $.ajax({
                dataType: 'JSON',
                type: 'post',
                data:{'cartid':cartid},
                url: "<?php echo base_url(); ?>removecartitem",
                success: function (s) { console.log(s); alert(s.description);
                    window.location=location.href;
                },
                error:function(e){console.log(e);}
            });
      }
     
    }
        </script>