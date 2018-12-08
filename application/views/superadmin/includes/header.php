<?php
$admin_userid = $this->session->userdata(PROJECT_SESS_ADMIN_CODE . 'id');
if (!num_check($admin_userid)) {
    redirect(base_url() . 'superadmin/Welcome/login');
} else {
    $admin_profilecode = $this->session->userdata(PROJECT_SESS_ADMIN_CODE . 'profilecode');
    $admin_name = $this->session->userdata(PROJECT_SESS_ADMIN_CODE . 'name');
    $admin_displayname = ucfirst($this->session->userdata(PROJECT_SESS_ADMIN_CODE . 'displayname'));
    $admin_role = $this->session->userdata(PROJECT_SESS_ADMIN_CODE . 'role');
}
?>
<div class="top-menu navbar-fixed-top col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 pull-left logo">
        <a href="<?php echo SITE_ADMIN_LINK; ?>"><img src="<?php echo LOGO_PATH; ?>" alt="<?php echo SITE_NAME; ?>" title="<?php echo SITE_NAME; ?> :: Dashboard"/></a>
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-9 pull-right myac">
        <ul class="nav top-nav pull-right">
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><img class="drp-dwn-img" src="<?php echo ADMIN_IMAGES_PATH; ?>user1.png" alt="user"><?php echo fetch_ucwords($admin_displayname); ?><img class="drp-dwn-img1" src="<?php echo ADMIN_IMAGES_PATH; ?>arrows.png" alt="setting"></a>
            </li>

        </ul>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="menu col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="container-fluid">
        <div class="navbar" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>
                <div class="navbar-collapse collapse" id='cssmenu'>

                    <!-- Left nav -->
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo SITE_ADMIN_LINK; ?>">Home</a></li>
                        <!--Categories Start-->
                        <li><a href="javascript:void(0);">Categories<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo SITE_ADMIN_LINK; ?>Categories/menu">Menu</a></li>
                                <li><a href="<?php echo SITE_ADMIN_LINK; ?>Categories/subMenu">Sub Menu</a></li>
                                <li><a href="<?php echo SITE_ADMIN_LINK; ?>Categories/listSubMenu">List Sub Menu</a></li>
                            </ul>
                        </li>
                        <!--Categories End-->
                        <!--Products Start-->
                        <li><a href="javascript:void(0);">Products<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo SITE_ADMIN_LINK; ?>Product/createProduct">Add Product</a></li>
                                <li><a href="<?php echo SITE_ADMIN_LINK; ?>Product">Product List</a></li>
                            </ul>
                        </li>
                        <!--Products End-->
                         <!--Products Start-->
                        <li><a href="javascript:void(0);">Product Settings<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo SITE_ADMIN_LINK; ?>Productsettings/producttype">Product Types</a></li>
                                <li><a href="<?php echo SITE_ADMIN_LINK; ?>Productsettings/models">Models</a></li>
                                <li><a href="<?php echo SITE_ADMIN_LINK; ?>Productsettings/brand">Brands</a></li>
                                <li><a href="<?php echo SITE_ADMIN_LINK; ?>Productsettings/shapes">Shapes</a></li>
                                <li><a href="<?php echo SITE_ADMIN_LINK; ?>Productsettings/colors">Colors</a></li>
                            </ul>
                        </li>
                        <!--Products End-->
						
						 <!--Orders tart-->
                        <li><a href="javascript:void(0);">Orders<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                        <li><a href="<?php echo SITE_ADMIN_LINK; ?>Orders">View Orders</a></li>
                                        <li><a href="<?php echo SITE_ADMIN_LINK; ?>Orders/enquiry">View Enquiries</a></li>
                            </ul>
                        </li>
                        <!--Orders End-->
                        
                      
                        <!--Site Settings-->
                        <li><a href="javascript:void(0);">Site Settings<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo SITE_ADMIN_LINK; ?>Settings/slider">Slider</a>
                                <li><a href="<?php echo SITE_ADMIN_LINK; ?>Cms/faq">Faq's</a>
                                <li><a href="<?php echo SITE_ADMIN_LINK; ?>Cms/testimonials">Testimonials</a>
                                <li><a href="<?php echo SITE_ADMIN_LINK; ?>Cms/newsletter">News Letter</a>
                            </ul>
                        <!--Site Settings end-->
                        <!--Profile Account Settings Start-->
                        <li><a href="javascript:void(0);">Profile<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            <li><a href="<?php echo SITE_ADMIN_LINK; ?>changepassword">Change Password</a>
                                        <li><a onclick="return confirm('Confirm to logout session ?')" href="<?php echo SITE_ADMIN_LINK; ?>Welcome/logOut">Logout</a>
                            </ul>
                        </li>
                        <li><a onclick="return confirm('Confirm to logout session ?')" href="<?php echo SITE_ADMIN_LINK; ?>Welcome/logOut">Logout</a>   
                        <!--Profile Account Settings End-->
                        
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container -->
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!--<li><a href="#">Services<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="legal-services.php">Legal Services</a></li>
                                <li><a href="legal-aid-counsels-magirstrate-court.php">Legal Aid Councel in Magistrate Court</a></li>
                                <li><a href="legal-literacy-legal-aid-clubs-in-schools.pdf" target="_blank">Legal Literacy/Legal Aid Clubs in Schools</a></li>
                                <li><a href="list-of-clinics-in-colleges.php">Legal Aid Clinics  in Colleges</a></li>  
                                <li><a href="para-legal-volunteers.php">Para Legal Volunteers</a></li>
                                <li><a href="nalsa.pdf" target="_blank">New Legal Services Schemes&nbsp;(NALSA)</a></li>
                                <li><a href="#">Download Forms<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="application%20-for-%20legal-services.pdf" target="_blank">Application For Legal Services in State</a></li>
                                        <li><a href="application-form-for-supreme-court.php">Application For Legal Services in Supreme Court</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>-->