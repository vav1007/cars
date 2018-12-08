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
    <style type="text/css"></style>
    </head>
    <body>

        <div class="main"> 
            <div class="container">
                <div class="mian-contain">

                    <!-- HEADER START -->
                    <?php $this->load->view(FRONT_HEADER_PATH); ?>
                    <!-- HEADER END -->

                    <!-- BANNER STRAT -->
                    <div class="banner">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="main-banner">
                                <!-- Slider section module code start -->
                                <?php 
                                $sliderReq = json_decode($slider);
                                if($sliderReq->code == 200){
                                    foreach($sliderReq->slider_result as $slider_res){
                                ?>
                                    <div class="item"> <img src="<?php echo $slider_res->sliderpath;  ?>" alt="<?php echo $slider_res->title;  ?>" title="<?php echo $slider_res->title;  ?>"/>
                                        <div class="banner-detail">
                                            <div class="banner-detail-inner">
                                                <span class="slogan"></span><br>
                                                <h1 class="banner-title"><?php echo fetch_ucfirst($slider_res->title); ?><span></span></h1>
                                                <p><?php echo fetch_ucfirst($slider_res->slidercontent); ?></p>
                                                <a href="<?php echo  $slider_res->urllink; ?>" class="btn btn-color">ORDER NOW</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } } ?>
                                <!-- Slider section module code end-->    
                                    
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- BANNER END --> 

                    <div class="container-inner">
                        <!-- CONTAIN START -->
                        <section class="ptb-30 ptb-xs-20">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-9 col-sm-8">
                                        <div class="sub-banner-block center-xs mb-30">
                                            <div class="row mlr_-5">
                                                <div class="col-sm-7 plr-5 hidden-xs">
                                                    <div class="sub-banner sub-banner1"> 
                                                        <a href="#"> 
                                                            <img src="<?php echo FRONT_IMAGES_PATH;  ?>sub-banner1.jpg" alt="SuperSote">
                                                            <div class="sub-banner-effect"></div>
                                                        </a> 
                                                    </div>
                                                </div>
                                                <div class="col-sm-5 plr-5 hidden-xs">
                                                    <div class="sub-banner sub-banner2"> 
                                                        <a href="#"> 
                                                            <img src="<?php echo FRONT_IMAGES_PATH;  ?>sub-banner2.jpg" alt="SuperSote">
                                                            <div class="sub-banner-effect"></div>
                                                        </a> 
                                                    </div>
                                                    <div class="sub-banner sub-banner3"> 
                                                        <a> 
                                                            <img src="<?php echo FRONT_IMAGES_PATH;  ?>sub-banner3.jpg" alt="SuperSote">
                                                            <div class="sub-banner-effect"></div>
                                                        </a> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-slider mb-30">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="">
                                                        <div id="tabs" class="category-bar mb-20 p-0">
                                                            <ul class="tab-stap">
                                                                <li><a class="tab-step1 selected" title="step1">Featured Products</a></li>
                                                                <li><a class="tab-step2" title="step2">Latest Products</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="featured-product">
                                                <div class="items">
                                                    <div class="tab_content pro_cat">
                                                        <ul>
                                                            <li>
                                                                <div id="data-step1" class="items-step1 selected product-slider-main position-r" data-temp="tabdata">
                                                                   <!--Listing Section Start-->
                                                                   <?php
                                                    $featureReq=json_decode($featured_products);
                                                    if($featureReq->code == 200){
                                                        foreach($featureReq->product_result as $product_res){
                                                            $product_id= $product_res->product_id;
                                                            $product_name= $product_res->product_name;
                                                            $productLink=base_url().'details/'.url_title($product_name).'/'.base64_encode($product_id);
                                                            $produt_image = $product_res->product_pic;
                                                            $mrp = $product_res->mrp;
                                                            $selling_price = $product_res->selling_price;
                                                            $rating = $product_res->rating;
                                                    ?>
													
                                                                    <div class="row mlr_-20">
                                                                        <div class="col-md-4 col-sm-6 col-xs-6 plr-20">
                                                                            <div class="product-item">
                                                                                <div class="sale-label hide"><span></span></div>
                                                                                <div class="product-image"> <a href="<?php echo $productLink; ?>"> <img src="<?php echo $produt_image;  ?>" alt="<?php echo $product_name;?>" title="<?php echo $product_name;?>"/> </a>
                                                                                    <div class="product-detail-inner">
                                                                                        <div class="detail-inner-left left-side">
                                                                                        <ul>
                                                                                <li class="pro-cart-icon">
                                                                                   
                                                                                        <a href="<?php echo $productLink; ?>" title="Add to Cart"></a>
                                                                                   
                                                                                </li>
                                                                                <li class="pro-wishlist-icon"><a href="javascript:void(0)" onclick="addToWishlist(<?php echo $product_id; ?>)" title="Wishlist"></a></li>
                                                                                <li class="pro-compare-icon"><a href="javascript:void(0)" onclick="addToCompare(<?php echo $product_id; ?>)" title="Compare"></a></li>
                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="product-item-details">
                                                                                    <div class="product-item-name"> <a href="<?php echo $productLink; ?>"><?php echo $product_name;  ?></a> </div>
                                                                                    <div class="price-box"> 
                                                                                        <span class="price">₹<?php echo $selling_price;  ?></span>
                                                                                        <del class="price old-price">₹<?php echo $mrp;  ?></del>
                                                                                        <div class="rating-summary-block right-side">
                                                                                            <div title="<?php echo $rating; ?>%" class="rating-result"> <span style="width:<?php echo $rating; ?>%"></span> </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                        <?php } } ?>
                                                                        <!--Listing Section end -->
                                                                       
                                                                      
                                                                       
                                                                        
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div id="data-step2" class="items-step2 product-slider-main position-r" data-temp="tabdata" style="display:none">
                                                                    <!--Listing Latest product module section start -->
                                                                    <?php
                                                        //echo $newselling_products;exit;
                                                    $latestReq=json_decode($latest_products);
                                                    if($latestReq->code == 200){
                                                        foreach($latestReq->product_result as $product_res){
                                                            $product_id= $product_res->product_id;
                                                            $product_name= $product_res->product_name;
                                                            $productLink=base_url().'details/'.url_title($product_name).'/'.base64_encode($product_id);
                                                            $produt_image = $product_res->product_pic;
                                                            $mrp = $product_res->mrp;
                                                            $selling_price = $product_res->selling_price;
                                                            $rating = $product_res->rating;
                                                    ?>
                                                                    <div class="row mlr_-20">
                                                                        <div class="col-md-4 col-sm-6 col-xs-6 plr-20">
                                                                            <div class="product-item">
                                                                                <div class="sale-label hide"><span>Sale</span></div>
                                                                                <div class="product-image"> 
                                                                                    <a href="<?php echo $productLink; ?>"> <img src="<?php echo $produt_image;  ?>" alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>" /> </a>
                                                                                    <div class="product-detail-inner">
                                                                                        <div class="detail-inner-left left-side">
                                                                                        <ul>
                                                                                <li class="pro-cart-icon">
                                                                                   
                                                                                        <a href="<?php echo $productLink; ?>" title="Add to Cart"></a>
                                                                                   
                                                                                </li>
                                                                                <li class="pro-wishlist-icon"><a href="javascript:void(0)" onclick="addToWishlist(<?php echo $product_id; ?>)" title="Wishlist"></a></li>
                                                                                <li class="pro-compare-icon"><a href="javascript:void(0)" onclick="addToCompare(<?php echo $product_id; ?>)" title="Compare"></a></li>
                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="product-item-details">
                                                                                    <div class="product-item-name"> <a href="<?php echo $productLink; ?>"><?php echo $product_name;  ?></a> </div>
                                                                                    <div class="price-box"> 
                                                                                        <span class="price">₹<?php echo $selling_price; ?></span>
                                                                                        <div class="rating-summary-block right-side">
                                                                                            <div title="<?php echo $rating; ?>%" class="rating-result"> <span style="width:<?php echo $rating; ?>%"></span> </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                        <?php } } ?>
                                                                       <!--Listing Latest product module section end  -->
                                                                        
                                                                       
                                                                      
                                                                        
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ser-feature-block center-sm mb-40">
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6 col-xs-6 feature-box-main">
                                                    <div class="feature-box feature1">
                                                        <div class="ser-title">Free Delivery</div>
                                                        <div class="ser-subtitle">From ₹59.89</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 feature-box-main">
                                                    <div class="feature-box feature2">
                                                        <div class="ser-title">Support 24/7</div>
                                                        <div class="ser-subtitle">Online 24 hours</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 feature-box-main">
                                                    <div class="feature-box feature3">
                                                        <div class="ser-title">Free return</div>
                                                        <div class="ser-subtitle">365 a day</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 feature-box-main">
                                                    <div class="feature-box feature4">
                                                        <div class="ser-title">Big Saving</div>
                                                        <div class="ser-subtitle">Weeken Sales</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                        <div class="product-slider">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="heading-part mb-20">
                                                        <h2 class="main_title">New Sellers</h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="position-r"><!-- dresses -->
                                                    <div class="owl-carousel pro_cat_slider"><!-- id="product-slider" -->
                                                        <!-- Listing section module start -->
                                                        <?php
                                                        //echo $newselling_products;exit;
                                                    $newsellingReq=json_decode($newselling_products);
                                                    if($newsellingReq->code == 200){
                                                        foreach($newsellingReq->product_result as $product_res){
                                                            $product_id= $product_res->product_id;
                                                            $product_name= $product_res->product_name;
                                                            $productLink=base_url().'details/'.url_title($product_name).'/'.base64_encode($product_id);
                                                            $produt_image = $product_res->product_pic;
                                                            $mrp = $product_res->mrp;
                                                            $selling_price = $product_res->selling_price;
                                                            $rating = $product_res->rating;
                                                    ?>
                                                        <div class="item">
                                                            <div class="product-item">
                                                                <div class="sale-label"><span>Sale</span></div>
                                                                <div class="product-image"> 
                                                                    <a href="<?php echo $productLink;  ?>"> <img src="<?php echo $produt_image;  ?>" alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>" /> </a>
                                                                    <div class="product-detail-inner">
                                                                        <div class="detail-inner-left left-side">
                                                                            <ul>
                                                                                <li class="pro-cart-icon">
                                                                                   
                                                                                        <a href="<?php echo $productLink; ?>" title="Add to Cart"></a>
                                                                                   
                                                                                </li>
                                                                                <li class="pro-wishlist-icon"><a href="javascript:void(0)" onclick="addToWishlist(<?php echo $product_id; ?>)" title="Wishlist"></a></li>
                                                                                <li class="pro-compare-icon"><a href="javascript:void(0)" onclick="addToCompare(<?php echo $product_id; ?>)" title="Compare"></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="product-item-details">
                                                                    <div class="product-item-name"> <a href="<?php echo $productLink; ?>"><?php echo $product_name; ?></a> </div>
                                                                    <div class="price-box"> 
                                                                        <span class="price">₹<?php echo $selling_price; ?></span> <del class="price old-price">₹<?php echo $mrp; ?></del>
                                                                        <div class="rating-summary-block right-side">
                                                                            <div title="<?php echo $rating; ?>%" class="rating-result"> <span style="width:<?php echo $rating; ?>%"></span> </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php } } ?>
                                                        <!--Listing section code end -->
                                                        
                                                       
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="heading-part mb-20">
                                                        <h2 class="main_title">Latest Blog</h2>
                                                    </div>
                                                    <div class="row blog-mobile-m">
                                                        <div id="news" class="owl-carousel">
                                                            <div class="item">
                                                                <div class="blog-item">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="blog-media"> 
                                                                                <div class="date">01<br>jun</div>
                                                                                <img src="<?php echo FRONT_IMAGES_PATH;  ?>blog_img1.jpg" alt="SuperSote"> 
                                                                                <a href="single-blog.html" title="Click For Read More" class="read">&nbsp;</a> 
                                                                            </div>
                                                                            <div class="blog-detail">
                                                                                <h3><a href="#">Summer Entertaining</a></h3>
                                                                                <p>Lorem khaled ipsum is a major key to success. It�s on you how you want to live your life. Everyone has a choice. I pick my choice, squeaky clean.</p>
                                                                                <hr>
                                                                                <div class="post-info">
                                                                                    <ul>
                                                                                        <li><span>By</span><a href="#"> cormon jons</a></li>
                                                                                        <li><a href="#">(5) comments</a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="blog-item">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="blog-media"> 
                                                                                <div class="date">01<br>jun</div>
                                                                                <img src="<?php echo FRONT_IMAGES_PATH;  ?>blog_img2.jpg" alt="SuperSote"> 
                                                                                <a href="#" title="Click For Read More" class="read">&nbsp;</a> 
                                                                            </div>
                                                                            <div class="blog-detail">
                                                                                <h3><a href="#">Summer Entertaining</a></h3>
                                                                                <p>Lorem khaled ipsum is a major key to success. It�s on you how you want to live your life. Everyone has a choice. I pick my choice, squeaky clean.</p>
                                                                                <hr>
                                                                                <div class="post-info">
                                                                                    <ul>
                                                                                        <li><span>By</span><a href="#"> cormon jons</a></li>
                                                                                        <li><a href="#">(5) comments</a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="blog-item">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="blog-media"> 
                                                                                <div class="date">01<br>jun</div>
                                                                                <img src="<?php echo FRONT_IMAGES_PATH;  ?>blog_img3.jpg" alt="SuperSote"> 
                                                                                <a href="#" title="Click For Read More" class="read">&nbsp;</a> 
                                                                            </div>
                                                                            <div class="blog-detail">
                                                                                <h3><a href="#">Summer Entertaining</a></h3>
                                                                                <p>Lorem khaled ipsum is a major key to success. It�s on you how you want to live your life. Everyone has a choice. I pick my choice, squeaky clean.</p>
                                                                                <hr>
                                                                                <div class="post-info">
                                                                                    <ul>
                                                                                        <li><span>By</span><a href="#"> cormon jons</a></li>
                                                                                        <li><a href="#">(5) comments</a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="blog-item">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="blog-media"> 
                                                                                <div class="date">01<br>jun</div>
                                                                                <img src="<?php echo FRONT_IMAGES_PATH;  ?>blog_img4.jpg" alt="SuperSote"> 
                                                                                <a href="#" title="Click For Read More" class="read">&nbsp;</a> 
                                                                            </div>
                                                                            <div class="blog-detail">
                                                                                <h3><a href="#">Summer Entertaining</a></h3>
                                                                                <p>Lorem khaled ipsum is a major key to success. It�s on you how you want to live your life. Everyone has a choice. I pick my choice, squeaky clean.</p>
                                                                                <hr>
                                                                                <div class="post-info">
                                                                                    <ul>
                                                                                        <li><span>By</span><a href="#"> cormon jons</a></li>
                                                                                        <li><a href="#">(5) comments</a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 mb-xs-30">
                                        <div class="sidebar-block">
                                            <div class="sidebar-box listing-box mb-30"> <span class="opener plus"></span>
                                                <div class="sidebar-title">
                                                    <h3><i class="fa fa-bars" aria-hidden="true"></i>Categories</h3>
                                                </div>
                                                <div class="sidebar-contant">
                                                    <ul>
                                                        <?php $catergoryReq = json_decode($level_three_categories); 
                                                            if($catergoryReq->code == SUCCESS_CODE){
                                                                foreach($catergoryReq->listsubmenu_result as $c_res){
                                                                    $catergoryLink = base_url().'/'.url_title($c_res->title).'/'.$c_res->listsubmenuid;
                                                                    ?>
                                                                    <li><a href="<?php echo $catergoryLink; ?>"><i class="fa fa-arrow-right"></i><?php echo fetch_ucfirst($c_res->title); ?></a></li>
                                                            <?php    }
                                                            }
                                                        ?>
                                                        
                                                       
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="sidebar-box sidebar-item mb-30 mb-xs-0">
                                                <span class="opener plus"></span>
                                                <div class="main_title sidebar-title">
                                                    <h3><span>Best</span> Seller</h3>
                                                </div>
                                                <div class="sidebar-contant">
                                                    <ul>
                                                    <!--Best selling items module section -->
                                                    <?php
                                                    $bestsellingReq=json_decode($best_selling);
                                                    if($bestsellingReq->code == 200){
                                                        foreach($bestsellingReq->product_result as $product_res){
                                                            $product_id= $product_res->product_id;
                                                            $product_name= $product_res->product_name;
                                                            $productLink=base_url().'details/'.url_title($product_name).'/'.base64_encode($product_id);
                                                            $produt_image = $product_res->product_pic;
                                                            $mrp = $product_res->mrp;
                                                            $selling_price = $product_res->selling_price;
                                                            $rating = $product_res->rating;
                                                    ?>
                                                        <li>
                                                            <div class="pro-media"> 
                                                                <a href="<?php echo $productLink; ?>"><img alt="SuperSote" src="<?php echo $produt_image;  ?>"></a> 
                                                            </div>
                                                            <div class="pro-detail-info">
                                                                <a href="<?php echo $productLink; ?>"><?php echo $product_name;  ?></a>
                                                                <div class="rating-summary-block">
                                                                    <div class="rating-result" title="<?php echo $rating; ?>%">
                                                                        <span style="width:<?php echo $rating; ?>%"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="price-box">
                                                                    <span class="price">₹<?php echo $selling_price; ?>.00</span>
                                                                </div>
                                                                <div class="cart-link">
                                                                    <form>
                                                                        <a href="<?php echo $productLink; ?>" title="Add to Cart">Add To Cart</a>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php } } ?>
                                                        <!--Best selling items module section end -->
                                                        
                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="sidebar-box mb-30 visible-sm visible-md visible-lg hidden-xs"> 
                                                <a href="#"><img src="<?php echo FRONT_IMAGES_PATH;  ?>left-banner.jpg" alt="SuperSote"></a> 
                                            </div>
                                            <div class="sidebar-box gray-box mb-30"> <span class="opener plus"></span>
                                                <div class="sidebar-title">
                                                    <h3>testimonials</h3>
                                                </div>
                                                <div class="sidebar-contant">
                                                    <div class="client-inner testimonial-block">
                                                        <div id="client" class="owl-carousel">
                                                            <!--testimonial section code start -->
                                                            <?php 
                                                                $testimonialReq = json_decode($testimonials);
                                                                if($testimonialReq->code == 200){
                                                                    foreach($testimonialReq->testimonial_result as $testimonial_res){
                                                            ?>
                                                            <div class="item client-detail">
                                                                <div class="client-img"> <img src="<?php echo $testimonial_res->userpic;  ?>" alt="<?php echo $testimonial_res->username;  ?>" title="<?php echo $testimonial_res->username;  ?>"/> </div>
                                                                <p>"<?php echo fetch_ucfirst(substr($testimonial_res->comment,0,70));  ?>..."</p>
                                                                <h4 class="sub-title client-title"><?php echo fetch_ucfirst($testimonial_res->username);  ?></h4>
                                                                <div class="date"><?php echo date('M d, Y',strtotime($testimonial_res->created_date));  ?></div>
                                                            </div>
                                                                    <?php } } ?>
                                                            <!--testimonial section code end-->
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sidebar-box sidebar-item hidden-xs">
                                                <div class="sidebar-title">
                                                    <h3>SUBSCRIBE EMAILS</h3>
                                                </div>
                                                <div class="sidebar-contant">
                                                    <div class="newsletter">
                                                        <div class="newsletter-inner"> <img src="<?php echo FRONT_IMAGES_PATH;  ?>newsletter-icon.png" alt="SuperSote">
                                                            <span>Get Latest News & Update</span>
                                                            <p>also the leap into electronic typesetting, remaining essentially</p>
                                                            <form>
                                                                <input type="email" placeholder="Your email address...">
                                                                <button class="btn-color" title="Subscribe">Subscribe</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- CONTAINER END --> 

                        <!-- CONTAIN START -->

                        <!-- Brand logo block Start  -->
                        <section>
                            <div class="">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="heading-part mb-20">
                                            <h2 class="main_title">Our Brands</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row brand">
                                    <div class="col-md-12">
                                        <div id="brand-logo" class="owl-carousel align_center">
                                            <!--Brand listing code start -->
                                            <?php 
                                            $brandReq = json_decode($brands);
                                            if($brandReq->code == 200){
                                                foreach($brandReq->brand_result as $brand_res){
                                                    $brand_link ="javascript:void(0)";
                                            ?>
                                            <div class="item"><a href="<?php echo $brand_link; ?>"><img src="<?php echo $brand_res->brand_icon;  ?>" alt="<?php echo $brand_res->brandname;  ?>" title="<?php echo $brand_res->brandname;  ?>"></a></div>
                                                <?php } } ?>
                                            <!--Brand listing code end-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Brand logo block End  --> 

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



    </body>
</html>
