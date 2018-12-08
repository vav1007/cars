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
        <link rel="shortcut icon" href="<?php echo LOGO_PATH; ?>">
        <!-- <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"> -->
    </head>
    <style>
        .toolbar-products {
          padding: 6px 21px;
/*          margin-bottom: 30px;*/
          display: inline-block;
          vertical-align: top;
          width: 100%;
          text-align: center;
          border: 2px solid #ebebeb;
          border-radius: 4px;
        }
        .toolbar-products .modes {
            float: left;
            margin-right: 20px;
        }
        .toolbar-products .toolbar-amount {
        float: left;
        }
        .toolbar-products .sorter, .toolbar-products .limiter, .toolbar-products .pages {
        float: right;
    }
        .toolbar-products .sorter, .toolbar-products .limiter, .toolbar-products .pages {
        float: right;
    }
    .toolbar-products .sorter {
    margin-left: 45px;
    display: inline-block;
    vertical-align: top;
    padding: 5px 0;
}
.toolbar-products .sorter label, .toolbar-products .limiter label {
    display: inline-block;
    vertical-align: top;
    line-height: 35px;
    margin: 0;
    color: #3e3e3e;
    font-size: 14px;
    margin-right: 8px;
}
.toolbar-products .sorter select, .toolbar-products .limiter select {
    padding: 0 15px;
    height: 35px;
    font-size: 13px;
    color: #898888;
    border-radius: 25px;
    display: inline-block;
    vertical-align: top;
    width: auto;
    border: 1px solid #e8e8e8;
    box-shadow: none;
}
.toolbar-products .limiter {
    display: inline-block;
    vertical-align: top;
    padding: 5px 0;
}
.toolbar-products .toolbar-amount {
    line-height: 35px;
    padding: 0;
    font-size: 12px;
    color: #8d8c8c;
    display: inline-block;
    vertical-align: top;
    padding: 5px 0;
    font-size: 14px;
}   
#search_filters {
    border: 1px solid #ebebeb;
    box-shadow: none;
    margin-bottom: 30px;
    padding: 0;
/*    float: right;*/
    width: 100%;
}        
#search_filters>h4 {
    display: table;
    margin: 0;
    padding: 15.5px 20px;
    background: #e51d02;
    color: #fff;
    font-weight: 400;
    width: 100%;
    font-size: 18px;
}
#search_filters .facet {
    border-bottom: 1px solid #ebebeb;
    float: left;
    margin: 0 27px;
    padding: 20px 0;
    width: calc(100% - 54px);
    margin-bottom: -1px;
}
#search_filters .facet .facet-title {
    color: #262626;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: 400;
} 
#search_filters .facet ul li {
    display: inline-block;
    min-width: 50%;
    float: left;
} 
.sublist-li {
    border: none;
    float: left;
/*    width: 90px;*/
    
}       
    </style>
    <style>
/* The container */
.containert {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 15px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.containert input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.containert:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.containert input:checked ~ .checkmark {
    background-color:#f36b11;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.containert input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.containert .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
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
                            <li><a href="#">Accessories</a></li>
                            <li class="active">Interior</li>
                        </ol>
                    </div>
                    <div class="container-inner">
                        <!-- CONTAIN START -->
                        <section class="ptb-30 ptb-xs-20">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-9 col-sm-8">
                                        <div class="product-slider mb-30">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="toolbar toolbar-products toolbar-top" style="">
                                                        <div class="modes">
<div class="btn-group hide">
  <button type="button" id="list-view" data-view="list" class="btn btn-default" data-toggle="tooltip" title="" data-original-title="List"><i class="fa fa-th-list"></i></button>
  <button type="button" id="grid-view" data-view="grid" class="btn btn-default  selected" data-toggle="tooltip" title="" data-original-title="Grid" style="color:#f36b11"><i class="fa fa-th"></i></button>
</div>
<!-- Nav tabs --></div>
                                                        <div class="toolbar-amount">
<?php $productReq=json_decode($product_details); ?>
<span>Showing 1 to <?php echo $productReq->total_product_count; ?> of <?php echo $productReq->total_product_count; ?> items
</span></div>
                                                        <div class="sorter"><label>Sort by:</label>
<select class="form-control" name="input-sort" id="input-sort">
<option value="0">All</option>
  <option value="featured">Featured</option>
  <option value="bestselling">Best Selling</option>
  <option value="latest">Latest</option>
  <option value="newtrending">New Trending</option>
</select>
</div>
                                                        <div class="limiter hide"><label>Show:</label>
<select name="" id="input-limit" class="form-control">
  <option value="10">10</option>
  <option value="20">20</option>
  <option value="30">30</option>
  <option value="all">All</option>
</select>
</div>
                                                    </div>
                                                   
                                                </div>
                                            </div><br/>
                                            <div class="featured-product">
                                                <div class="items">
                                                    <div class="tab_content pro_cat">
                                                        <ul>
                                                            <li>
                                                                <div id="data-step1" class="items-step1 selected product-slider-main position-r" data-temp="tabdata">
                                                                    <div class="row mlr_-20">
                                                                        <!--Listing Start -->   
                                                                        <?php
                                                                        
                                                                        if($productReq->code == 200){
                                                                            foreach($productReq->product_result as $product_res){
                                                                                $product_id= $product_res->product_id;
                                                                                $product_name= $product_res->product_name;
                                                                                $productLink=base_url().'details/'.url_title($product_name).'/'.base64_encode($product_id);
                                                                                $produt_image = $product_res->product_pic;
                                                                                $mrp = $product_res->mrp;
                                                                                $selling_price = $product_res->selling_price;
                                                                                $rating = $product_res->rating;
                                                                        ?>
                                                                        <div class="col-md-4 col-sm-6 col-xs-6 plr-20">
                                                                            <div class="product-item">
                                                                                <div class="sale-label hide"><span>sale</span></div>
                                                                                <div class="product-image"> <a href="<?php echo $productLink; ?>"> <img src="<?php echo $produt_image;  ?>" alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>"/> </a>
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
                                                                                        <span class="price">₹<?php echo $selling_price; ?></span>
                                                                                        <del class="price old-price">₹<?php echo $mrp; ?></del>
                                                                                        <div class="rating-summary-block right-side">
                                                                                            <div title="<?php echo $rating; ?>%" class="rating-result"> <span style="width:<?php echo $rating; ?>%"></span> </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                            <?php } } ?>
                                                                        <!--Listing end -->
                                                                        
                                                                        
                                                                        
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 mb-xs-30">
                                        <div class="sidebar-block">
<!--
                                            <div id="MainMenu">
                                                <div class="list-group panel">
                                                    <a href="#demo1" class="list-group-item list-group-item-success strong" style="background: #f7f7f7;" data-toggle="collapse" data-parent="#MainMenu"><i class="fa fa-inr"></i> Price Range <i class="fa fa-caret-down"></i></a>
                                                   
                                                    <a href="#demo2" class="list-group-item list-group-item strong" data-toggle="collapse" data-parent="#MainMenu"><i class="fa fa-car"></i> Car Model <i class="fa fa-caret-down"></i></a>
                                                    <div class="collapse list-group-submenu" id="demo2">
                                                        <a href="#" class="list-group-item"><input type="checkbox">&nbsp;Audi</a>
                                                        <a href="#" class="list-group-item"><input type="checkbox">&nbsp;Bently 1234</a>
                                                        <a href="#" class="list-group-item"><input type="checkbox">&nbsp;alto vxi</a>
                                                        <a href="#" class="list-group-item"><input type="checkbox">&nbsp;wagnor lxi</a>
                                                        <a href="#" class="list-group-item"><input type="checkbox">&nbsp;XUV 500</a>
                                                    </div>
                                                    <a href="#demo4" class="list-group-item list-group-item strong" data-toggle="collapse" data-parent="#MainMenu"><i class="fa fa-bars"></i> Categories <i class="fa fa-caret-down"></i></a>
                                                    <div class="collapse list-group-submenu" id="demo4">
                                                        <a href="#" class="list-group-item"><input type="checkbox">&nbsp; Whells</a>
                                                        <a href="#" class="list-group-item"><input type="checkbox">&nbsp; Mirrors</a>
                                                        <a href="#" class="list-group-item"><input type="checkbox">&nbsp; Lights</a>
                                                        <a href="#" class="list-group-item"><input type="checkbox">&nbsp; Audio</a>

                                                    </div>

                                                </div>
                                            </div>
-->
                                            
                                            <div class="sidebar-box listing-box mb-30"> <span class="opener plus"></span>
                                                <div class="sidebar-title">
                                                    <h3><i class="fa fa-bars" aria-hidden="true"></i>Filter By</h3>
                                                </div>
                                                <div class="sidebar-contant" style="height: auto;overflow: hidden;">
                                                    <ul class="">
                                                        
                                                        <li><a><i class=""></i>price</a>
                                                            <div class="sublist">
                                                            <ul>
                                                                <!--Range slider-->
                                                     <div class=" list-group-submenu" id="demo1" style="width: 220px;height: 100px;margin: 0 auto;">
                                                        <p style="width:80px; margin:0 auto;">
                                                            <input type="text" id="amount" name="amount" style="border: 0; color: #f6931f; font-weight: bold;" onclick="side()"/>
                                                        </p>
                                                        <div id="slider-range" style="width:150px; margin:0 auto; margin-top:13px;"></div>
                                                        <div class="clearfix">&nbsp;</div>
                                                   </div>
                                                    <!--Range slider end --> 
                                                               
                                                               
                                                            </ul>
                                                            </div>
                                                        </li>
                                                        <li><a><i class=""></i>color</a>
                                                            <div class="sublist">
                                                            <ul class="row">
                                                            <!--Color-->
                                                            <?php 
                                                          $color_req=json_decode($color_details);
                                                          if($color_req->code == 200){
                                                          foreach($color_req->colors as $color_res){ ?>
                                                                <li class="sublist-li col-md-2">
                                                                    <label class="containert">
                                                                      <input type="checkbox" name="color[]" value="<?php echo $color_res->colorid; ?>" class="filterClass"/>
                                                                      <span class="checkmark" style="background-color:<?php echo $color_res->color; ?>;"></span>
                                                                    </label>
                                                                </li>
                                                          <?php } } ?>
                                                             <!--Color-->
                                                            </ul>
                                                            </div>
                                                        </li>
                                                        <li><a><i class=""></i>Brand</a>
                                                            <div class="sublist">
                                                            <ul>
                                                            <?php 
                                                                 $brand_req=json_decode($brand_details);
                                                                    if($brand_req->code == 200){
                                                                     foreach($brand_req->brands as $brand_res){ ?>
                                                                <li class="sublist-li">
                                                                    <label class="containert"><?php echo $brand_res->brand; ?>
                                                                      <input type="checkbox"  name="brand[]" value="<?php echo $brand_res->brandid; ?>" class="filterClass">
                                                                      <span class="checkmark"></span>
                                                                    </label>
                                                                </li>
                                                                     <?php } } ?>
                                                            </ul>
                                                            </div>
                                                        </li>
                                                        <li><a><i class=""></i>Product Type</a>
                                                            <div class="sublist">
                                                            <ul>
                                                            <?php 
                                                                $type_req=json_decode($type_details);
                                                                if($type_req->code == 200){
                                                                foreach($type_req->producttypes as $type_res){ ?>
                                                                <li class="sublist-li">
                                                                    <label class="containert"><?php echo fetch_ucfirst($type_res->producttype); ?>
                                                                    <input type="checkbox"  name="type[]" value="<?php echo $type_res->typeid; ?>" class="filterClass">
                                                                      <span class="checkmark"></span>
                                                                    </label>
                                                                </li>
                                                                <?php } } ?>
                                                            </ul>
                                                            </div>
                                                        </li>
                                                         <li><a><i class=""></i>Model</a>
                                                            <div class="sublist">
                                                            <ul>
                                                                <?php 
                                                                $model_req=json_decode($model_details);
                                                                if($model_req->code == 200){
                                                                foreach($model_req->models as $model_res){ ?>
                                                                <li class="sublist-li">
                                                                    <label class="containert"><?php echo ucfirst($model_res->model); ?>
                                                                    <input type="checkbox"  name="model[]" value="<?php echo $model_res->modelid; ?>" class="filterClass">
                                                                      <span class="checkmark"></span>
                                                                    </label>
                                                                </li>
                                                                <?php } } ?>
                                                            </ul>
                                                            </div>
                                                        </li>
                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                              <div class="sidebar-box listing-box mb-30"> <span class="opener plus"></span>
                                                <div class="sidebar-title">
                                                    <h3><i class="fa fa-bars" aria-hidden="true"></i>Categories</h3>
                                                </div>
                                                <div class="sidebar-contant">
                                                    <ul class="border">
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

<script>
                        $(function() {
                            $("#slider-range").slider({
                                range: true,
                                min: 0,
                                max: 50000000,
                                values: [0, 50000000],
                                slide: function(event, ui) {
                                    $("#amount").val(ui.values[ 0 ] + " Rs - " + ui.values[ 1 ] + " Rs");
                                    side();
                                }
                            });
                            $("#amount").val($("#slider-range").slider("values", 0) + " Rs  -  " +
                                    $("#slider-range").slider("values", 1) + " Rs");
                        });
                    </script>


    </body>
</html>
