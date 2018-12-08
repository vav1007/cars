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
    <style>.error{color:red;}</style>
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
                            <li class="active">Login</li>
                        </ol>
                    </div>
                    <div class="container-inner">
                        <!-- CONTAIN START -->
                        <section class="ptb-30 ptb-xs-20">
                            <div class="">
                                <div class="row">
                                    <div class="col-main">
                                  <div class="account-create">
                                    <div class="page-title">
                                        <h1>Login Here</h1>
                                    </div>
                                    <form action="" method="post" id="user_signin" name="user_signin">
        <div class="col2-set">
            <div class="col-1 new-users col-md-6">
                <div class="content">
                    <h2>New Customers</h2>
                    <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                </div>
            </div>
            <div class="col-2 registered-users col-md-6">
                <div class="content">
                    <h2>Registered Customers</h2>
                    <p>If you have an account with us, please log in.</p>
                    <ul class="form-list">
                        <li>
                            <label for="email" class="required"><em>*</em>Email / Mobile</label><span class="error" id="login_username_error"></span>
                            <div class="input-box">
                                <input type="text" name="loginusername" value="" id="login_username" class="input-text required-entry validate-email" title="Email/ Mobile" placeholder="Enter Email / mobile" maxlength="60" autofocus="on"/>
                            </div>
                        </li>
                        <li>
                            <label for="pass" class="required"><em>*</em>Password</label>
                            <div class="input-box">
                                <input type="password" name="loginpassword" id="login_password" placeholder="Enter Password" class="input-text required-entry validate-password" title="Enter password" maxlength="20"/>
                            </div>
                        </li>
                    </ul>
                    <p class="required">* Required Fields</p>
                </div>
            </div>
        </div>
        <div class="row">
        <input type="hidden" name="cur_url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]"; ?>">
            <div class="col-md-6" style="text-align:right;">
                <div class="buttons-set">
                    <a href="<?php echo base_url(); ?>register" title="Create an Account" class="btn btn-danger loginBtnSection"><span><span>Create an Account</span></span></a>
                </div>
                
            </div>
            <div class="col-md-6" style="text-align:right;">
            <div class="loginHideSection"></div>
                <div class="buttons-set ">
                    <a href="" class="f-left hide">Forgot Your Password?</a>
                    <button type="submit" class="button btn btn-warning  loginBtnSection" title="Login" name="send" id="send2"><span><span>Login</span></span></button>
                </div>
            </div>
        </div>
            </form>
                                   
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
    <script type="text/javascript">
    $('#user_signin').on('submit',function(e){
e.preventDefault();
str = true;
        $('#login_username_error,#login_password_error').html('');
        var username = $('#login_username').val();
        var password = $('#login_password').val(); 
        if(username==''){str=false;$('#login_username_error').html('  Please enter email / mobile');}
        if(password==''){str=false;$('#login_password_error').html('  Please enter password');}
       // if(password!='' && (password_check(password)==0)){str=false;$('#login_password_error').html('Enter valid password with minimum 6 characters');}
        
        if (str == true)
        {
           $('.loginBtnSection').hide('');
           $('.loginHideSection').html("<img style='height:100px' src='<?php echo LOOADING_IMAGE; ?>'>");
          var formdetails = JSON.stringify($('#user_signin').serializeObject());
            $.ajax({
                dataType: 'JSON',
                type: 'post',
                data:formdetails,
                url: "<?php echo base_url(); ?>api/login",
                success: function (s) {
                    //alert(s.description);
                    console.log(s);
                    if (s.code == 200)
                    {
                        $('.loginHideSection').html(s.description).css({'color': 'green'});
                        setTimeout(function () {
                            window.location = s.redirection_link;
                        }, 2000);
                    } else
                    {
                        $('.loginHideSection').html(s.description).css({'color': 'red'});
                        
                            $('.loginBtnSection').show('');
                    }

                },
                error: function (er) {
                    console.log(er);
                }
            });
        }
return str;
});
$('#Forgot-Password-Form').on('submit',function(e){
e.preventDefault();
str = true;
        $('#forgot_error').html('');
        var username = $('#forget_username').val();
        if(username==''){str=false;$('#forgot_error').html('Please enter email / mobile');}
        if (str == true)
        {
           $('.forgotBtnSection').hide('');
           $('.forgotHideSection').html("<img style='height:100px' src='<?php echo LOOADING_IMAGE; ?>'>");
          var formdetails = JSON.stringify($('#Forgot-Password-Form').serializeObject());
            $.ajax({
                dataType: 'JSON',
                type: 'post',
                data:formdetails,
                url: "<?php echo base_url(); ?>api/forgotpassword",
                success: function (s) {
                    //alert(s.description);
                    console.log(s);
                    if (s.code == 200)
                    {
                        $('.forgotHideSection').html(s.description).css({'color': 'green'});
                        setTimeout(function () {
                            window.location = s.redirection_link;
                        }, 2000);
                    } else
                    {
                        $('.forgotHideSection').html(s.description).css({'color': 'red'});
                        
                            $('.forgotBtnSection').show('');
                    }

                },
                error: function (er) {
                    console.log(er);
                }
            });
        }
return str;

});
    </script>
</html>
