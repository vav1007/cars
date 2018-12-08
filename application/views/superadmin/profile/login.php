<?php
defined('BASEPATH') or die('Error occured while page loading');
/*
 * Page Name            : login.php
 * Page Type             :  View
 * Page Purpose         : Super admin Login
 * Controller Name     : --
 * Alias                      : projectname_/superadmin
 * Designed By           : Mouli
 * Designed On           : --
 * Design Completed On  : --
 * Created By            : Venkateswara Achari
 * Created On            : 20-04-2016
 * Modified By          : 
 * Modified On          : 
 * Extra notes            :
 * Folder Path           : views/superadmin/profile/login.php
 */
?>
<!DOCTYPE HTML>
<html>
    <head>
        <!-- Project Related Code Start -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo SUPERADMIN_TITLE; ?><?php echo $url_title; ?></title>
        <meta name="description" content="<?php echo META_TAGS; ?>"/>
        <meta name="keywords" content="<?php echo META_KEYWORDS; ?>"/>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo FAVICON_PATH; ?>">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Project Related Code End -->
        <link rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS_PATH;  ?>structure.css">
        <link href="<?php echo ADMIN_CSS_PATH;  ?>bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Custom CSS -->
        <link href="<?php echo ADMIN_CSS_PATH;  ?>custom.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMIN_CSS_PATH;  ?>responsive.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMIN_CSS_PATH;  ?>font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <style type="text/css">.error{color:red;font-weight:bold;} sup{color:red;}</style>
    </head>
    <body>
        <?php $this->load->view(ADMIN_INCLUDES_PATH . 'login_header'); /* Loading the Login Header */ ?>
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form class="box login" id="superadmin_login">
                <div class="boxBody">
                    <label> Email<sup>*</sup></label>
                    <input type="text" name="username" id="username" tabindex="1" placeholder="username@mail.com"  autocomplete="off" maxlength="60" />
                    <div class="error" id="username_error"></div>
                    <label>Password<sup>*</sup></label>
                    <input type="password" name="userpassword" id="userpassword" tabindex="2"  placeholder="*********" maxlength="20"/>
                    <div class="error" id="userpassword_error"></div>
                </div>
                <div class="clearfix"></div>
                <footer>

                    <input type="submit" class="btnLogin" value="Login" tabindex="4">
                    <div class="error" id="log_error_message"> </div>
                </footer>
            </form>
        </div>
        <div class="clearfix"></div>
        <footer>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="container-fluid">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-left ft-left">
                    <a href="<?php echo base_url(); ?>"><?php echo SITE_DOMAIN; ?></a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right ft-right text-right">
                    <p>Developed By&nbsp;:&nbsp;<a href="<?php echo DEVELOPED_LINK;  ?>" target="_new"><?php echo DEVELOPED_BY;  ?></a></p>
                </div>
            </div>
             <div class="clearfix"></div>
        </div>
         <div class="clearfix"></div>
    </footer>
<!--successfull message-->
  
    </body>
</html>
<script src="<?php echo ADMIN_JS_PATH; ?>jquery.min.js"></script>
<script type="text/javascript">
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
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
//    $('#result').text(JSON.stringify($('#superadmin_login').serializeObject()));
        
$(function() {
    $('#superadmin_login').submit(function(ls) {
        ls.preventDefault();
        str=true;
        $('#log_error_message,#username_error,#userpassword_error').text('');
        $('#username,#userpassword').css('border','');
        var user_name=$('#username').val();
        var user_password=$('#userpassword').val();
        if(user_name=='') { $('#username').css('border','1px solid red');$('#username_error').html('Please enter useremail');str=false; }
        if(user_password=='') { $('#userpassword').css('border','1px solid red');$('#userpassword_error').html('Please enter password');str=false; }
        if(str==true)
        {
            $('#log_error_message').html('Please wait...').css({'color':'green','font-weight':'bold'});
            var logdata=JSON.stringify($('#superadmin_login').serializeObject());
                $.ajax({
                    dataType:'JSON',
                   method:'POST',
                   data:logdata,
                   url:"<?php echo SITE_ADMIN_LINK; ?>Welcome/logAuth",
                   success:function(data){console.log(data);
                        switch(data.code)
                    {
                        case 200:
                        $('#log_error_message').html(data.description).css({'color':'green','font-weight':'bold'});
                            window.location=data.redirection; break;
                        case 204:
                        case 301:
                        case 422:
                        $('#log_error_message').html(data.description).css({'color':'red','font-weight':'bold'});
                            break;
                    }
                    },
                   error:function(e){console.log(e);}

                });
            }
            return str;
    });
});
</script>
