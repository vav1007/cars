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
        <link rel="shortcut icon" href="<?php LOGO_PATH; ?>">
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
                            <li class="active">success</li>
                        </ol>
                    </div>
                    <div class="container-inner">
                        <!-- CONTAIN START -->
                        <section class="ptb-30 ptb-xs-20">
                            <div class="">
                                <div class="row">
                                   <div class="col-md-12 my-wishlist">
	<div class="table-responsive">
		<table class="table" style="border:none">
			<thead>
				<tr>
					<th colspan="4" class="heading-title">My Wishlist</th>
				</tr>
			</thead>
			<tbody>
				<tr class="hide">
					<td class="col-md-2"><img src="images/pro-11.jpg" alt="imga"></td>
					<td class="col-md-7" style="vertical-align:middle">
						<div class="product-name"><a href="#">Floral Print Buttoned</a></div>
                        <div class="rating-summary-block left-side">
                            <div title="53%" class="rating-result"> <span style="width:53%"></span> </div>
                        </div>
						<div class="rating rateit">
							<span class="review">( 06 Reviews )</span>
                        </div>
						<div class="price">
							<strike>$400.00</strike>
							<span>$900.00</span>
						</div>
					</td>
					<td class="col-md-2" style="vertical-align:middle">
						<a href="#" class="btn-upper btn btn-primary">Add to cart</a>
					</td>
					<td class="col-md-1 close-btn" style="vertical-align:middle">
						<a href="#" class=""><i class="fa fa-times"></i></a>
					</td>
				</tr>
                <tr class="hide">
					<td class="col-md-2"><img src="images/pro-12.jpg" alt="imga"></td>
					<td class="col-md-7" style="vertical-align:middle">
						<div class="product-name"><a href="#">Floral Print Buttoned</a></div>
                        <div class="rating-summary-block left-side">
                            <div title="53%" class="rating-result"> <span style="width:53%"></span> </div>
                        </div>
						<div class="rating rateit">
							<span class="review">( 06 Reviews )</span>
                        </div>
						<div class="price">
							<strike>$400.00</strike>
							<span>$900.00</span>
						</div>
					</td>
					<td class="col-md-2" style="vertical-align:middle">
						<a href="#" class="btn-upper btn btn-default">Add to cart</a>
					</td>
					<td class="col-md-1 close-btn" style="vertical-align:middle">
						<a href="#" class=""><i class="fa fa-times"></i></a>
					</td>
				</tr>
				<tr>
                    <td colspan="4"><div class="alert alert-danger text-center">No wishlist items found..</div></td>
                </tr>   
			</tbody>
		</table>
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
    </body>
</html>
