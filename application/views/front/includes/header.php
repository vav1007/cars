<!-- HEADER START -->
<?php
//print_r($this->session->all_userdata());
                    $user_sess_log_status =  $this->session->userdata('user_login_status');    
                    $user_sess_name='';
                    if($user_sess_log_status == 1){
                      $user_sess_id = $this->session->userdata(US_EXT.'userid'); 
                      $user_sess_name = $this->session->userdata(US_EXT.'username'); 
                      $main_sess_userid=$this->session->userdata(US_EXT.'sess_userid'); 
                    }
                    ?>
<header class="container" id="header">
        <div class="header-top">
          <div class="">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                   <div class="top-link right-side" style="float:left;">
                    <div class="social-icon">
                      <ul>
                      <?php if($user_sess_log_status==0){ ?>
                        <li><a href="<?php echo base_url(); ?>login" class="right-links" aria-hidden="true">Login</a></li>
                        <li><a href="<?php echo base_url(); ?>register" class="right-links" aria-hidden="true">Register</a></li>
                        <li ><a href="myaccount.php" class="right-links" aria-hidden="true" style="width:140px">My Account</a></li>
                      <?php }  else { ?>
                        <li><a href="<?php echo base_url(); ?>profile" class="right-links" aria-hidden="true" style="width:200px">Dear <?php echo $user_sess_name; ?></a></li>
                        <li><a href="<?php echo base_url(); ?>profile" class="right-links" aria-hidden="true" style="width:100px">My account</a></li>
                        <li ><a onclick="return confirm('Confirm to logout profile ?')" href="<?php echo base_url(); ?>logout" class="right-links" aria-hidden="true" style="width:140px">Logout</a></li>
                      <?php } ?>
                      </ul>
                    </div>
                  </div>
<!--
                <div class="top-link top-link-left">
                  <ul>
                    <li class="sitemap-icon">
                      <div class="float-left-xs header-right-link">
                        <ul>
                          <li class="account-icon"> <a href="#">My Account</a>
                            <div class="header-link-dropdown account-link-dropdown">
                              <ul class="link-dropdown-list">
                                <li> <span class="dropdown-title">Default welcome msg!</span>
                                  <ul>
                                    <li><a href="#">Sign In</a></li>
                                    <li><a href="#">Create an Account</a></li>
                                  </ul>
                                </li>
                              </ul>
                            </div>
                          </li>
                            <li class="account-icon"><a href="signin.php">Login</a>
                            </li>
                            <li class="account-icon"><a href="signup.php">Register</a>
                            </li>
                        </ul>
                      </div>
                    </li>  
                  </ul>
                </div>
-->
              </div>
                <div class="col-md-6 col-sm-6 col-xs-12 hidden-xs">
                  <div class="top-link right-side">
                    <div class="social-icon">
                      <ul>
                        <li><a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="rss"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="header-middle">
          <div class="container-inner">
          <div class="header-inner">
            <div class="navbar-header">
              <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"><i class="fa fa-bars"></i>
              </button>
              <a class="navbar-brand page-scroll" href="<?php echo base_url(); ?>"> <img alt="SuperSote" src="<?php echo LOGO_PATH; ?>"> </a> 
            </div>
            
            <div class="right-side float-left-xs header-right-link">
                <ul>
                  <li class="main-search">
                    <div class="header_search_toggle desktop-view">
                      <form>
                        <div class="search-box">
                          <input class="input-text" type="text" placeholder="Search here...">
                          <button class="search-btn"></button>
                        </div>
                      </form>
                    </div>
                  </li>
                  <?php if($user_sess_log_status==0){ ?>
                    <li>
                        <a href="<?php echo base_url(); ?>login"><i class="fa fa-heart"></i></a>
                    </li> 
                  <?php } else { ?>
                    <a href="<?php echo base_url(); ?>wishlist"><i class="fa fa-heart"></i></a>
                  <?php } ?>
                    <?php
                    $header_cartsession=$this->session->userdata('cartsession');
                    $item_count=0;
                    $url=base_url().'Cart/headercartlist/'.$header_cartsession;
                    $ch = curl_init();
                    $timeout = 5;
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                    $cart_req = curl_exec($ch);
                    curl_close($ch);
                    $cartReq = json_decode($cart_req);
                    // /var_dump($cartReq);
                    ?>
                  <li class="cart-icon"> <a href="#"><span> <!-- <small class="cart-notification"></small> --> </span>  ₹<?php echo $cartReq->sub_total; ?></a>
                    <div class="cart-dropdown header-link-dropdown">
                      <ul class="cart-list link-dropdown-list">
                        <!--Cart listing section Start-->
                        <?php
                            if($cartReq->code == SUCCESS_CODE){
                            foreach($cartReq->cart_result as $cart_res){
                            $productLink = base_url().'details/'.url_title($cart_res->product_name).'/'.base64_encode($cart_res->product_id);
                            $productname = fetch_ucfirst($cart_res->product_name);
                        ?>
                        <li> <a class="close-cart" href="javascript:void(0)" onclick="removeCartItem(<?php echo $cart_res->id;  ?>)"><i class="fa fa-times-circle"></i></a>
                          <div class="media"> <a class="pull-left"> <img alt="SuperSote" src="<?php echo $cart_res->product_pic; ?>"></a>
                            <div class="media-body"> <span><a><?php echo $productname; ?></a></span>
                              <p class="cart-price">₹<?php echo $cart_res->sellingprice; ?></p>
                              <div class="product-qty">
                                <label>Qty:</label>
                                <div class="custom-qty">
                                  <input type="text" readonly name="qty" maxlength="8" value="<?php echo $cart_res->cart_qty; ?>" title="Qty" class="input-text qty">
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                            <?php } } else { ?>
                              <li><div class="alert alert-danger">No items found..!</div></li>
                            <?php } ?>
                       <!--Cart listing section end -->
                      </ul>
                      <p class="cart-sub-totle"> <span class="pull-left">Cart Subtotal</span> <span class="pull-right"><strong class="price-box cart_subtotal"><?php echo $cartReq->sub_total; ?></strong></span> </p>
                      <div class="clearfix"></div>
                      <div class="mt-20"> <a href="<?php echo base_url(); ?>cart" class="btn-color btn">Cart</a> 
                      <?php
                      if($cartReq->code == SUCCESS_CODE){
                      ?>
                      <a href="<?php echo base_url(); ?>checkout" class="btn-color btn right-side">Checkout</a> </div>
                      <?php } ?>
                    </div>
                  </li>
                </ul>
              </div>
            <div class="header_search_toggle mobile-view">
              <form>
                <div class="search-box">
                  <input class="input-text" type="text" placeholder="Search entire store here...">
                  <button class="search-btn"></button>
                </div>
              </form>
            </div>
          </div>
          </div>
        </div>
      </header>
      
      <div  class="navbar navbar-custom grey-color"><div class="float-none-sm">
              <div id="menu" class="navbar-collapse collapse left-side">
                  <ul class="nav navbar-nav navbar-left">
                  <li class="active"><a href="index.php">Home</a></li>
                 <!--Looping section code start -->
                 <?php
                    $header_cartsession=$this->session->userdata('cartsession');
                    $item_count=0;
                    $url=base_url().'Welcome/headerMenuList';
                    $ch = curl_init();
                    $timeout = 5;
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                    $statistics_req = curl_exec($ch);
                    curl_close($ch);
                    $headerMenuReq = json_decode($statistics_req);
                    ?>
                    <?php  if($headerMenuReq->code == SUCCESS_CODE){ 
                        foreach($headerMenuReq->menu_result as $menuRes){
                      ?>
                  <li class="level"> <span class="opener plus"></span> <a href="javascript:void(0)" class="page-scroll"><?php echo $menuRes->title; ?></a>
                      <div class="megamenu mobile-sub-menu">
                        <div class="megamenu-inner-top">
                          <ul class="sub-menu-level1">
                            <li class="level2">
                              <ul class="sub-menu-level2 ">
                              <?php
                              foreach($menuRes->submenu_result as $submenu_res){
                                $menulink = base_url().'menulist/'.url_title($submenu_res->title).'/'.base64_encode($submenu_res->id);
                              ?>
                                <li class="level3"><a href="<?php echo $menulink; ?>"><?php echo fetch_ucfirst($submenu_res->title); ?></a></li>
                              <?php } ?>
                              </ul>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </li>
                    <?php } } ?>
                    <!--Looping section code end-->
                    <li><a href="#">Specifications</a></li>
                    <li><a href="#">Future cars</a></li>
                    <li class="level"> <span class="opener plus"></span> <a href="#" class="page-scroll">Custom-make</a>
                      <div class="megamenu mobile-sub-menu">
                        <div class="megamenu-inner-top">
                          <ul class="sub-menu-level1">
                            <li class="level2">
                              <ul class="sub-menu-level2 ">
                                <li class="level3"><a href="#">Upload pictures</a></li>
                                <li class="level3"><a href="#">Modify  </a></li>
                                <li class="level3"><a href="#">Accessories  </a></li>
                                <li class="level3"><a href="#">Add to photo </a></li>
                                <li class="level3"><a href="#">Add to cart</a></li>
                              </ul>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </li>
                    <li class="level"> <span class="opener plus"></span> <a href="#" class="page-scroll">Others</a>
                      <div class="megamenu mobile-sub-menu">
                        <div class="megamenu-inner-top">
                          <ul class="sub-menu-level1">
                            <li class="level2">
                              <ul class="sub-menu-level2 ">
                                <li class="level3"><a href="#">Body style</a></li>
                                <li class="level3"><a href="#">Make own model  </a></li>
                                <li class="level3"><a href="#">Color  </a></li>
                                <li class="level3"><a href="#">Price </a></li>
                              </ul>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </li>
                    <li class="level"> <span class="opener plus"></span> <a href="#" class="page-scroll">Help</a>
                      <div class="megamenu mobile-sub-menu">
                        <div class="megamenu-inner-top">
                          <ul class="sub-menu-level1">
                            <li class="level2">
                              <ul class="sub-menu-level2 ">
                                <li class="level3"><a href="#">Posts</a></li>
                                <li class="level3"><a href="#">Search  </a></li>
                                <li class="level3"><a href="#">Contact us  </a></li>
                                <li class="level3"><a href="#">Delivery details </a></li>
                              </ul>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </li>
                    <li><a href="<?php echo base_url(); ?>gallery">Gallery</a></li>
                  </ul>
                </div>
            </div></div>
      <!-- HEADER END -->