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
        <style type="text/css">.error{color:red;}</style>
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
                            <li class="active">Register</li>
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
                                        <h1>Create an Account</h1>
</div>
            <form action="" method="post" id="user_singup" name="user_signup">
                                        <div class="fieldset">
                                           
                                            <h2 class="legend">Personal Information</h2>
                                            <ul class="form-list">
                                                <li class="fields">
                                                    <div class="customer-name">
                                                        <div class="field name-firstname">
                                                            <label for="firstname" class="required"><em>*</em>User Name</label>&nbsp;&nbsp;<span class="error" id="username_error"></span>
                                                            <div class="input-box">
                                                                <input type="text" id="username" name="username" value="" placeholder="User Name" title="User Name" maxlength="69" class="input-text required-entry" autocomplete="off" />
                                                                
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="field name-lastname">
                                                            <label for="lastname" class="required"><em>*</em>Email</label>&nbsp;&nbsp;<span class="error" id="useremail_error"></span>
                                                            <div class="input-box">
                                                            <input type="text" id="useremail" name="useremail" value="" placeholder="User email" title="Email" maxlength="60" class="input-text required-entry" autocomplete="off" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="fields">
                                                    <div class="customer-name">
                                                        <div class="field name-firstname">
                                                            <label for="firstname" class="required"><em>*</em>Mobile</label>&nbsp;&nbsp;<span class="error" id="usermobile_error"></span>
                                                            <div class="input-box">
                                                                <input type="text" id="usermobile" name="usermobile" value="" placeholder="Mobile" title="Mobile" maxlength="10" class="input-text required-entry" autocomplete="off"/>
                                                                
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="field name-lastname">
                                                            <label for="lastname" class="required"><em>*</em>Password</label>&nbsp;&nbsp;<span class="error" id="userpassword_error"></span>
                                                            <div class="input-box">
                                                            <input type="password" id="userpassword" name="userpassword" value="" placeholder="password" title="password" maxlength="30" class="input-text required-entry" autocomplete="off" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="fields">
                                                    <div class="customer-name">
                                                        <div class="field name-firstname">
                                                            <label for="firstname" class="required"><em>*</em>Confirm Password</label>&nbsp;&nbsp;<span class="error" id="confirm_password_error"></span>
                                                            <div class="input-box">
                                                                <input type="password" id="confirm_password" name="confirm_password" value="" placeholder="Confirm Password" title="Confirm Password" maxlength="30" class="input-text required-entry" autocomplete="off"/>
                                                                
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                      <div class="clearfix">&nbsp;</div>
                                        <div class="buttons-set">
                                            <p class="required">* Required Fields</p>
                                            <p class="back-link col-md-3 text-center signupHideSection"></p>
                                            <button type="submit" title="Submit" class="btn btn-danger pull-right submitBtnSection " >
                                                <span><span>Register</span></span></button>                               
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
    $('#user_singup').on('submit',function(e){
e.preventDefault();
str = true;
        $('#username_error,#useremail_error,#usermobile_error,#userpassword_error,#confirm_password_error').html('');
        var fullname = $('#username').val();
        var email = $('#useremail').val(); 
        var mobile = $('#usermobile').val();
        var password = $('#userpassword').val();
        var confirm_password = $('#confirm_password').val();
       
        if(fullname==''){str=false;$('#username_error').html('Please enter username');}
        if(email==''){str=false;$('#useremail_error').html('Please enter email');}
        if(mobile==''){str=false;$('#usermobile_error').html('Please enter mobile');}
        if(password==''){str=false;$('#userpassword_error').html('Please enter password');}
        if(confirm_password==''){str=false;$('#confirm_password_error').html('Please enter confirm password');}
        
        if(fullname!='' && (alphabets_check(fullname)==0)){str=false;$('#username_error').html('Numbers & special characters not accepted');}
        if(email!='' && (email_check(email)==0)){str=false;$('#useremail_error').html('Enter valid email');}
        if(mobile!='' && (mobile_check(mobile)==0)){str=false;$('#usermobile_error').html('Enter valid mobile number');}
        if(password==''){str=false;$('#userpassword_error').html('Enter valid password with minimum 6 characters');}
        if(password!='' && confirm_password!='' && password!=confirm_password){str=false;$('#confirm_password_error').html('confirm password should be same with password');}
        if (str == true)
        {
           
            //$('.submitBtnSection').hide('');
            //$('.signupHideSection').html("<img style='height:100px' src='<?php echo LOOADING_IMAGE; ?>'>");
            var formdetails = JSON.stringify($('#user_singup').serializeObject());
            $.ajax({
                dataType: 'JSON',
                type: 'post',
                data:formdetails,
                url: "<?php echo base_url(); ?>api/signup",
                success: function (s) {
                    // alert(s.description);
                    console.log(s);
                    if (s.code == 200)
                    {
                        $('.signupHideSection').html(s.description).css({'color': 'green'});
                        setTimeout(function () {
                            window.location = '';
                        }, 2000);
                    } else
                    {
                        $('.signupHideSection').html(s.description).css({'color': 'red'});
                        
                            
                            $('.submitBtnSection').show('');
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
