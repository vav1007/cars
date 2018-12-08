<!DOCTYPE html>
<?php
//echo $product_details;exit;
$productReq=json_decode($product_details);
$pageAccess=1;
$productStatus= $productReq->code;
if($productStatus == 200)
{
    $pageAccess=1;
   
}
else
{
    //$pageAccess=0;
    //redirect(base_url());
}
?>
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
        <link rel="shortcut icon" href="<?php echo LOGO_PATH; ?>">
    </head>
    <body>

        <div class="main"> 
            <div class="container">
                <div class="mian-contain">

                    <!-- HEADER START -->
                    <?php $this->load->view(FRONT_HEADER_PATH); ?>
                    <!-- HEADER END -->
                    <?php
                    if($pageAccess==1){
                        $productRes=$productReq->product_result;
                        $productid=$productRes->product_id;
                    ?>
                    <div class="container">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li><a href="#"><?php echo fetch_ucfirst($productRes->submenu_name); ?></a></li>
                            <li class="#"><a href="#"><?php echo fetch_ucfirst($productRes->listsubmenu_name); ?></a></li>
                            <li class="active"><?php echo fetch_ucfirst($productRes->product_name); ?></li>
                        </ol>
                    </div>
                    <?php } ?>
                    <?php
                    if($pageAccess==1){   ?>
<!--Main section code start-->
                    <div class="container-inner">
                        <!-- CONTAIN START -->
                        <section class="ptb-30 ptb-xs-20">
                            <div class="">
                                <div class="row">
                                    <div class="preview col-md-6">
                                        <div class="preview-pic tab-content">
                                            <div class="tab-pane active" id="pic-2"><img src="<?php echo $productRes->product_org_pic; ?>" style="height:450px;width:450px;"/></div>
                                            <div class="tab-pane" id="pic-3"><img src="https://i5.walmartimages.com/asr/a53642b0-801b-4bce-b016-cd4b47e456d1_1.2a5398965ce85de59c4200139b5143d7.jpeg?odnHeight=450&odnWidth=450&odnBg=FFFFFF" /></div>
                                            <div class="tab-pane" id="pic-4"><img src="https://i5.walmartimages.com/asr/0ba7fc0b-05b0-4e41-b9cb-8efa81e67244_1.e724721fe7ee829767ae9cfeb7b4e0aa.png?odnHeight=450&odnWidth=450&odnBg=FFFFFF" /></div>
                                        </div>
                                        <ul class="preview-thumbnail nav nav-tabs">
                                            <li><a data-target="#pic-2" data-toggle="tab"><img src="<?php echo $productRes->product_pic; ?>" /></a></li>
                                            <li><a data-target="#pic-3" data-toggle="tab"><img src="https://i5.walmartimages.com/asr/a53642b0-801b-4bce-b016-cd4b47e456d1_1.2a5398965ce85de59c4200139b5143d7.jpeg?odnHeight=180&odnWidth=180&odnBg=FFFFFF" /></a></li>
                                            <li><a data-target="#pic-4" data-toggle="tab"><img src="https://i5.walmartimages.com/asr/0ba7fc0b-05b0-4e41-b9cb-8efa81e67244_1.e724721fe7ee829767ae9cfeb7b4e0aa.png?odnHeight=180&odnWidth=180&odnBg=FFFFFF" /></a></li>
                                        </ul>
                                    </div>
                                    <div class="details col-md-6">
                                        <h3 class="product-title"><?php echo fetch_ucfirst($productRes->product_name); ?></h3>
                                        <div class="rating">
                                            <div class="stars">
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                            </div>
                                            <span class="review-no">0 reviews | <a href="#">Add Your Review</a></span>
                                        </div>
                                        <div class="">
                                            <p>SKU:<strong><?php echo fetch_ucfirst($productRes->sku_code); ?></strong><p>
                                            <p>shipping with in:<strong><?php echo $productRes->shipping_days; ?>-<?php echo $productRes->shipping_days+2; ?> days</strong></p>
                                            <p>category:<a href="#"><strong>car Tires</strong></a></p>
                                            <p class="product-description"><?php echo fetch_ucfirst(substr($productRes->description,0,150)); ?>..<a href="#">Click Here For More Info</a></p>
                                        </div>
                                        <h4 class="">M.R.P: <span class="old-price">₹ <?php echo $productRes->mrp; ?>&nbsp;/-</span></h4>
                                        <h4 class="price">current price: <span>₹ <?php echo $productRes->selling_price; ?>&nbsp;/-</span></h4>
                                        <!-- <p class="vote"><strong>shipping charges :₹<?php echo $productRes->shipping_charges; ?>&nbsp;/-</strong></p> -->
                                        <div class="section" style="padding-bottom:20px;">
                                            <h6><strong>QTY: </strong>
                                                <span class="btn-minus glyphicon glyphicon-minus"></span>
                                                <input readonly value="1" class="qty number_class" name="cart_qty" id="cart_qty" maxlength="2"/>
                                                <span class="btn-plus glyphicon glyphicon-plus"></span>
                                            </h6>                
                                        </div> 
                                        <div class="action">
                                            <button class="add-to-cart btn btn-default" type="button" onclick="addToCart(<?php echo $productid; ?>)">add to cart</button>
                                            <button class="like btn btn-default" type="button" onclick="addToWishlist(<?php echo $productid; ?>)"><span class="fa fa-heart"></span></button>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-top:20px;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="">
                                                    <div id="tabs" class="category-bar mb-20 p-0">
                                                        <ul class="tab-stap">
                                                            <li><a class="tab-step1 selected" title="step1">About This item</a></li>
                                                            <li><a class="tab-step2" title="step2">Customer Reviews</a></li>
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
                                                                <div class="row mlr_-20">
                                                                    <div class="product-about">
                                                                        <h2 class="">About this Item</h2>
                                                                        <div class="">
                                                                        <div class="">
                                                                                <div class="">
                                                                                    <p><b>Brand:  </b><?php echo fetch_ucfirst($productRes->brand_name); ?></p> 
                                                                                </div>
                                                                            </div>
                                                                        <div class="">
                                                                                <div class="">
                                                                                    <p><b>Color:  </b><?php echo fetch_ucfirst($productRes->color_name); ?></p> 
                                                                                </div>
                                                                            </div>
                                                                            <div class="">
                                                                                <div class="">
                                                                                    <p><b>Model:  </b><?php echo fetch_ucfirst($productRes->modelname); ?></p> 
                                                                                </div>
                                                                            </div>
                                                                            <div class="">
                                                                                <div class="">
                                                                                    <p><b>Shape:  </b><?php echo fetch_ucfirst($productRes->shape_name); ?></p> 
                                                                                </div>
                                                                            </div>
                                                                            <div class=""><span class="">Disclaimer:</span><span></span>
                                                                                <div class="">
                                                                                    <p><b><?php echo $productRes->description; ?></b></p> 
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    </li>
                                                                    <li>
                                                                        <div id="data-step2" class="items-step2 product-slider-main position-r" data-temp="tabdata" style="display:none">
                                                                            <div class="row mlr_-20">
                                                                                <div class="review-section ReviewsHeader-container ReviewHeader-margin-l">
                                                                                    <h2>Customer reviews</h2>
                                                                                    <div class="">
                                                                                        <div class="Grid">
                                                                                            <div class="Grid-col u-size-1-1 u-size-1-2-s valign-middle u-size-1-4-m">
                                                                                                <div class="ReviewsHeader-ratingContainer ReviewHeader-margin-xs">
                                                                                                    <span class="ReviewsHeader-rating"><span style="font-size:40px;">0</span><span>out of 0</span>
                                                                                                    </span>
                                                                                                </div>
                                                                                                <div class="stars">
                                                                                                    <span class="fa fa-star fa-3x "></span>
                                                                                                    <span class="fa fa-star fa-3x "></span>
                                                                                                    <span class="fa fa-star fa-3x "></span>
                                                                                                    <span class="fa fa-star fa-3x"></span>
                                                                                                    <span class="fa fa-star fa-3x"></span>
                                                                                                </div>
                                                                                                <a href="#">see all 0 reviews</a>
                                                                                            </div>
                                                                                            <br/>
                                                                                            <strong>Top Customer Reviews</strong>
                                                                                            <br/>
                                                                                            <div class="review hide">
                                                                                                <img src="https://images-eu.ssl-images-amazon.com/<?php echo FRONT_IMAGES_PATH;  ?>S/amazon-avatars/default._CR0,0,1024,1024_SX48_.png" width="34px"></img> <span>santhosh reddy</span>
                                                                                                <div class="stars">
                                                                                                    <span class="fa fa-star checked"></span>
                                                                                                    <span class="fa fa-star  checked"></span>
                                                                                                    <span class="fa fa-star  checked"></span>
                                                                                                    <span class="fa fa-star "></span>
                                                                                                    <span class="fa fa-star "></span>
                                                                                                    <strong>Except installation everything good. It working awesome</strong>
                                                                                                </div>
                                                                                                <p>28 March 2018 |<span style="color:#ff9f1a">Verified Purchase</span></p>
                                                                                                <p>Installation has done finally after delivered 3 days... Except installation everything good. It working awesome..For installation they have charged ₹. 1770.00 from me.₹1500.00 for installation and ₹270 GST total ₹1770.</p>
                                                                                                <div>
                                                                                                    <a href="#">comment   |</a> 15 people found this helpful. Was this review helpful to you?
                                                                                                    <button type="button" class="btn btn-sm">yes</button>
                                                                                                    <button type="button" class="btn btn-sm">no</button>
                                                                                                    <a href="#">Report Abuse</a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="review">
                                                                                            <div class="alert alert-danger text-center">No results found..!</div>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-9 col-sm-8">
                                            <div class="product-slider">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="heading-part mb-20">
                                                            <h2 class="main_title">Related Products</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="position-r"><!-- dresses -->
                                                        <div class="owl-carousel pro_cat_slider"><!-- id="product-slider" -->
                                                             <!--Listing start-->
                                                             <?php
                                                        //echo $newselling_products;exit;
                                                    $relatedReq=json_decode($featured_products);
                                                    if($relatedReq->code == 200){
                                                        foreach($relatedReq->product_result as $product_res){
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
                                                                    <div class="sale-label hide"><span>Sale</span></div>
                                                                    <div class="product-image"> 
                                                                        <a href="<?php echo $productLink; ?>"> <img src="<?php echo $produt_image;  ?>" alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>"/> </a>
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
                                                            <!--Listing end-->
                                                           
                                                            
                                                            
                                                           
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 mb-xs-30">
                                            <div class="sidebar-block">
                                                <div class="sidebar-box sidebar-item mb-30 mb-xs-0">
                                                    <span class="opener plus"></span>
                                                    <div class="main_title sidebar-title">
                                                        <h3><span>Best</span> Seller</h3>
                                                    </div>
                                                    <div class="sidebar-contant">
                                                        <ul>
                                                        <!--Listing Best selling Module section code start -->
                                                        <?php
                                                        
                                                        $bestReq=json_decode($best_selling);
                                                    if($bestReq->code == 200){
                                                        foreach($bestReq->product_result as $product_res){
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
                                                                        <div class="rating-result" title="<?php echo $rating;  ?>%">
                                                                            <span style="width:<?php echo $rating;  ?>%"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="price-box">
                                                                        <span class="price">₹<?php echo $selling_price; ?></span>
                                                                    </div>
                                                                    <div class="cart-link">
                                                                       
                                                                            <a href="<?php echo $productLink; ?>"  title="Add to Cart">Add To Cart</a>
                                                                       
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php } } else { ?>
                                                        <li><div class="alert alert-danger text-center">No items found</div></li>
                                                        <?php } ?>
                                                            <!--Listing Best selling Module section code end-->
                                                           
                                                          
                                                        </ul>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </section>

                    </div>
<!--main section end here -->
                    <?php } ?>
                    <!-- FOOTER START -->
                    <?php $this->load->view(FRONT_FOOTER_PATH); ?>
                    <!-- FOOTER END -->
                </div>
            </div>

            <script src="<?php echo FRONT_JS_PATH;  ?>fotorama.js"></script>
            <script src="<?php echo FRONT_JS_PATH;  ?>jquery.magnific-popup.js"></script>  
            <script src="<?php echo FRONT_JS_PATH;  ?>owl.carousel.min.js"></script> 
            <script src="<?php echo FRONT_JS_PATH;  ?>custom.js"></script>
    </body>
    
</html>
