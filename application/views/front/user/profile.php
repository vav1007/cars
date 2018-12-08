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
    <style>
.part-one {
padding: 12px;
    margin-bottom: 16px;}
.shadow{
background-color: #f5f5f5;
border-radius: 2px;
box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08);
}
.content-div{
    padding: 5px 0px 0px 16px;
    width: calc(100% - 50px);
}
.con-two {
    padding-top: 3px;
    font-size: 16px;
    font-weight: 500;
    text-transform: capitalize;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
} 
.part-label {
    padding: 0 0 12px 20px;
    font-size: 16px;
    font-weight: 500;
    color: #878787;
} 
._1zr6a1 {
    border-bottom: solid 2px white;
}
.NqIFxw {
    font-size: 14px;
    padding: 12px 5px 12px 66px;
    cursor: pointer;
}
.HDbIt8 {
    font-weight: 500;
    color: #f36b11;
    background-color: #fbf7f5;
} 
.ipubox {
    background-color: #ffffff;
    padding-left: 11px;
    border: 1px solid #f1f1f1;
    width: 201px;
    height: 47px;
    border-radius: 6px;
    
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
                            <li class="active">Profile</li>
                        </ol>
                    </div>
                    <div class="container-inner">
                        <!-- CONTAIN START -->
                        <section class="ptb-30 ptb-xs-20">
                            <div class="">
                                <div class="row" style="display:-webkit-flex">
                                   <div style="width:25%;margin-left: 25px;">
                                      <?php $this->load->view('front/user/profile_navbar'); ?>
                                    </div>
                                   <div style="width:75%;padding-left:16px;">
                                       <div style="min-height:300px">
                                           <div class="shadow">
                                               <div style="padding: 24px 32px 0;">
                                                   <div style="padding-bottom: 56px;">
                                                       <div style="padding-bottom: 24px;">
                                                           <span style="font-size: 18px;font-weight: 500;padding-right: 24px;">personal info</span>
                                                           <span style="font-size: 14px;font-weight: 500;color:#f36b11;cursor: pointer;">Edit</span>
                                                       </div>
                                                       <form>
                                                           <div style="display:-webkit-flex">
                                                           <div style="padding-bottom: 2px;display:-webkit-flex">
                                                               <div style="width: 270px;padding-right: 12px;">
                                                                   <div style="position: relative;margin-bottom: 10px;">
                                                                       <input type="text" value="jyothi" required readonly class="ipubox"/>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                           <div style="padding-bottom: 2px;display:-webkit-flex">
                                                               <div style="width: 270px;padding-right: 12px;">
                                                                   <div style="position: relative;margin-bottom: 10px;">
                                                                       <input type="text" value="m" required readonly class="ipubox"/>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                           </div>
                                                       </form>
                                                   </div>
                                                    <div style="padding-bottom: 56px;">
                                                       <div style="padding-bottom: 24px;">
                                                           <span style="font-size: 18px;font-weight: 500;padding-right: 24px;">Email Address</span>
                                                           <span style="font-size: 14px;font-weight: 500;color:#f36b11;cursor: pointer;">Edit</span> |
                                                           <span style="font-size: 14px;font-weight: 500;color:#f36b11;cursor: pointer;">Change password</span>
                                                       </div>
                                                       <form>
                                                           <div style="padding-bottom: 2px;display:-webkit-flex">
                                                               <div style="width: 270px;padding-right: 12px;">
                                                                   <div style="position: relative;margin-bottom: 10px;">
                                                                       <input type="text" value="jyothi@gmail.com" required readonly class="ipubox"/>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                           
                                                           
                                                       </form>
                                                   </div>
                                                    <div style="padding-bottom: 56px;">
                                                       <div style="padding-bottom: 24px;">
                                                           <span style="font-size: 18px;font-weight: 500;padding-right: 24px;">Mobile Number</span>
                                                           <span style="font-size: 14px;font-weight: 500;color:#f36b11;cursor: pointer;">Edit</span>
                                                           
                                                       </div>
                                                       <form>
                                                           <div style="padding-bottom: 2px;display:-webkit-flex">
                                                               <div style="width: 270px;padding-right: 12px;">
                                                                   <div style="position: relative;margin-bottom: 10px;">
                                                                       <input type="text" value="9652316446" required readonly class="ipubox"/>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </form>
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
